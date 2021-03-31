<?php

namespace Modules\Products\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Account\Models\User;
use Modules\AttributeDetails\Models\AttributeDetail;
use Modules\Booths\Models\Booth;
use Modules\Products\Models\Product;
use Modules\Products\Resources\Products as ProductsResource;
use Modules\Products\Resources\Product as ProductResource;
use Illuminate\Http\Request;
use Modules\Categories\Models\Category;
use Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 18);
        return ProductsResource::collection(Product::paginateFilter($request, $perPage));
    }

    public function new(Request $request)
    {
        return ProductsResource::collection(Product::orderBy('id', 'desc')->paginateFilter($request)->take(4));
    }

    public function show($id)
    {
        return new ProductResource(Product::where('status', 2)->where('id', $id)->first());
    }
    public function relate(Request $request)
    {
        return ProductsResource::collection(Product::paginateFilter($request)->take(3));
    }
    public function productsOfUser($id){
        return new ProductResource(Product::findOrFail($id));
    }
    public function store(Request $request)
    {

        $user_id = $request['user_id'];
        if(!$user_id)
            return $this->sendResponse(false, '!login');

        $user = User::findOrFail($user_id);

        $data = $request->only('name', 'description', 'origin_id', 'condition_id', 'price', 'discount', 'amount', 'classification_group_one', 'status', 'weight', 'length', 'width', 'height');
        $data['user_id'] = $user_id;
        $data['booth_id'] = $user['booth_id'];
        $data['slug'] = Str::slug($data['name'], '-');
        $booth = Booth::findOrFail($user['booth_id']);
        $data['province_id'] = $booth['province_id'];

        if($request['avatar']){
            $file = $request->file('avatar');
            $number = mt_rand(1000,99999);
            $imageName = $number.time() . '.' . $file->clientExtension();
            $path_avatar = public_path('/images/products/'. $user_id);
            if (!$path_avatar) {
                File::makeDirectory($path_avatar, $mode = 0777, true, true);
                $file->move($path_avatar, $imageName);
                $data['avatar'] = '/images/products/' . $user_id . '/' . $imageName;
            } else {
                $file->move($path_avatar, $imageName);
                $data['avatar'] = '/images/products/' . $user_id . '/' . $imageName;
            }
        }
        $arrGroupTwo = [];
        if($request['classification_group_two']){
            $arrGroupTwo['name'] = $request['classification_group_two'];
            foreach (json_decode($request['dataTwo'], true) as $key => $value){
                $arrGroupTwo['value'][] = $value['name'];
            }
        }
        $data['classification_group_two'] = count($arrGroupTwo)  ? json_encode($arrGroupTwo) : NULL;

        $product = new Product();
        $product->fill($data);
        $product->save();

        foreach (json_decode($request['id_categories']) as $value){
            $category = Category::findOrFail($value);
            $product->categories()->attach($category);
        }

        //Lưu danh sách ảnh vào bảng Image
        $arrImg['product_id'] = $product['id'];
        for ($i = 0; $i < $request['countFile']; $i++){
            $image = new Image();
            $fileImage = $request->file('fill'.$i);
            $imageName = mt_rand(10000,99999999).$i. '.' . $fileImage->clientExtension();
            $fileImage->move(public_path('/images/products/'. $user_id), $imageName);
            $arrImg['url'] = '/images/products/' . $user_id . '/' . $imageName;
            $image->fill($arrImg);
            $image->save();
        }
        if($request['classification_group_one']){
            $dataGroupOnes = $request['dataOne'];
            foreach (json_decode($dataGroupOnes, true) as $key => $val){
                $arrAttr = [];
                $arrAttr['product_id'] = $product['id'];
                $arrAttr['discount'] = $val['price'] ? $val['price'] : 0;
                $arrAttr['amount'] = $val['number'] ? $val['number'] : 0;
                $arrAttr['name'] = $val['name'];
                if($request->file('imgAtt'.$key)){
                    $fileImage = $request->file('imgAtt'.$key);
                    $imageName = mt_rand(10000,99999999).$i. '.' . $fileImage->clientExtension();
                    $fileImage->move(public_path('/images/products/'. $user_id), $imageName);
                    $arrAttr['image'] = '/images/products/' . $user_id . '/' . $imageName;
                }
                $productAttribute = new ProductAttribute();
                $productAttribute->fill($arrAttr);
                $productAttribute->save();

                if(!$product['discount']){
                    if($val['price']){
                        $product['discount'] = $val['price'];
                    }
                }
                if (count($val['attribute']) > 0) {
                    foreach ($val['attribute'] as $attribute) {
                        $attributes=[];
                        $attributes['name'] = $attribute['name_'];
                        $attributes['discount'] = $attribute['price_'];
                        $attributes['amount'] = $attribute['number_'];
                        $attributes['product_attribute_id'] = $productAttribute['id'];
                        if(!$product['discount']){
                            if($attribute['price_']){
                                $product['discount'] = $attribute['price_'];
                            }
                        }
                        if(!$productAttribute['amount'])
                            $productAttribute['amount'] = $attribute['number_'];

                        if(!$productAttribute['discount'])
                            $productAttribute['discount'] = $attribute['price_'];

                        $attribute = new AttributeDetail();
                        $attribute->fill($attributes);
                        $attribute->save();
                    }
                    $productAttribute->save();
                }
                $product->save();
            }

        }

        //Push Notification
        $notification = [];
        $notification['status'] = 0;
        $notification['to_id'] = 1;
        $notification['to_name'] = 'Admin';
        $notification['from_name'] = $user['name'];
        $notification['from_id'] = $user_id;
        $notification['title']  = $user['name'].'thêm mới sản phẩm';
        $notification['content'] = $user['name']. 'đã thêm mới 1 sản phẩm <a href="/admin/products/'.$product['id'].'">Chi tiết</a>';
        $notification['type'] = 2;
        $this->pushNotification($notification);

        return $this->sendResponse(true, 'success');
    }
    public function booth(Request $request){
        return ProductsResource::collection(Product::paginateFilter($request));
    }
    public function update(Request $request)
    {
        $count = 0;
        $count1 = 0;
        $product_id = $request['product_id'];
        $product = Product::findOrFail($product_id);
        $user_id = $request['user_id'];
        if(!$user_id)
            return $this->sendResponse(false, '!login');
        $data = $request->only('name', 'description', 'origin_id', 'condition_id', 'price', 'discount', 'amount', 'classification_group_one', 'status', 'weight', 'length', 'width', 'height');
        $data['slug'] = Str::slug($data['name'], '-');

        if($request->hasFile('avatar'))
        {
            Storage::put($product->avatar, File::get($request->avatar));
        }
        $arrGroupTwo = [];
        if($request['classification_group_two']){
            $arrGroupTwo['name'] = $request['classification_group_two'];
            foreach (json_decode($request['dataTwo'], true) as $key => $value){
                $arrGroupTwo['value'][] = $value['name'];
            }
        }
        $data['classification_group_two'] = count($arrGroupTwo)  ? json_encode($arrGroupTwo) : NULL;

        $product->fill($data);
        $product->save();

        $product->categories()->sync(json_decode($request['id_categories'], true));


        //Lưu danh sách ảnh vào bảng Image
        
        $files = $request->fill_edit;

        if ($files)
        {
            foreach ($files as $id => $file) 
            {
                $image = Image::find($id);
                Storage::put($image->url, File::get($file));
            }
        }

        // xóa danh sách bảng image
        $removes = $request->delete_image;
        if ($removes) 
        {
            $removes = json_decode($removes);
            foreach ($removes as $id) 
            {
                $image = Image::find($id);
                Storage::delete($image->url);
                $image->delete();
            }
        }

        $files = $request->fill;

        if ($files)
        {
            foreach ($files as $id => $file) 
            {
                $image = [
                    'url' => '/images/products/' . $user_id . '/' . $id . '.' . $file->clientExtension(),
                    'product_id' => $product_id
                ];

                Storage::put($image['url'], File::get($file));
                Image::create($image);
            }
        }

        if($request['id_delete_product_attribute'])
        {
            foreach (json_decode($request['id_delete_product_attribute'], true) as $id)
            {
                $proAtt = ProductAttribute::findOrFail($id);
                if ($proAtt) 
                {
                    Storage::delete($proAtt->image);
                    $proAtt->delete();
                }
            }
        }
        if($request['id_delete_attribute_detail']){
            foreach (json_decode($request['id_delete_attribute_detail'], true) as $id){
                $attDet = AttributeDetail::findOrFail($id);
                $attDet->delete();
            }
        }

        $removes = $request->imgAttRemoves;
        if ($removes) 
        {
            $removes = json_decode($removes);
            foreach ($removes as $id) 
            {
                $productAttr = ProductAttribute::find($id);
                Storage::delete($productAttr->image);
                $productAttr->update(['image' => '']);
            }
        }

        if($request['classification_group_one']){
            $dataGroupOnes = $request['dataOne'];
            foreach (json_decode($dataGroupOnes, true) as $key => $val){
                if(isset($val['id']) && $val['id'])
                {
                    $productAttr = ProductAttribute::findOrFail($val['id']);
                    $productAttr['discount'] = $val['price'] ? $val['price'] : 0;
                    $productAttr['amount'] = $val['number'] ? $val['number'] : 0;
                    $productAttr['name'] = $val['name'];
                    
                    if(isset($request->imgAtt[$val['id']]))
                    {
                        $file = $request->imgAtt[$val['id']];
                        if (!$productAttr->image) 
                        {
                            $productAttr->image = '/images/products/'. $user_id . '/' . time() . $count1++ . '.' . $file->clientExtension();
                        }
                        Storage::put($productAttr->image, File::get($file));
                    }
                    $productAttr->save();

                    if(!$product['discount']){
                        if($val['price']){
                            $product['discount'] = $val['price'];
                        }
                    }
                    if (count($val['attribute']) > 0) {
                        foreach ($val['attribute'] as $attribute) {
                            if(isset($attribute['id_'])){
                                $attDetail = AttributeDetail::findOrFail($attribute['id_']);
                                $attDetail['name'] = $attribute['name_'];
                                $attDetail['discount'] = $attribute['price_'];
                                $attDetail['amount'] = $attribute['number_'];
                                $attDetail->save();
                            }else{
                                $attributes=[];
                                $attributes['name'] = $attribute['name_'];
                                $attributes['discount'] = $attribute['price_'];
                                $attributes['amount'] = $attribute['number_'];
                                $attributes['product_attribute_id'] = $val['id'];
                                $att = new AttributeDetail();
                                $att->fill($attributes);
                                $att->save();
                            }
                            if(!$productAttr['amount'])
                                $productAttr['amount'] = $attribute['number_'];

                            if(!$productAttr['discount'])
                                $productAttr['discount'] = $attribute['price_'];

                            $productAttr->save();
                        }
                    }
                }
                else
                {
                    $arrAttr = [];
                    $arrAttr['product_id'] = $product['id'];
                    $arrAttr['discount'] = $val['price'] ? $val['price'] : 0;
                    $arrAttr['amount'] = $val['number'] ? $val['number'] : 0;
                    $arrAttr['name'] = $val['name'];
                    
                    if (isset($request->imgAttNew[$count])) 
                    {
                        $file = $request->imgAttNew[$count];
                        $arrAttr['image'] = '/images/products/'. $user_id . '/' . time() . $count++ . '.' . $file->clientExtension();
                        Storage::put($arrAttr['image'], File::get($file));
                    }
        
                    $productAttribute = new ProductAttribute();
                    $productAttribute->fill($arrAttr);
                    $productAttribute->save();
                    if (count($val['attribute']) > 0) {
                        foreach ($val['attribute'] as $attribute) {
                            $attributes=[];
                            $attributes['name'] = $attribute['name_'];
                            $attributes['discount'] = $attribute['price_'];
                            $attributes['amount'] = $attribute['number_'];
                            $attributes['product_attribute_id'] = $productAttribute['id'];

                            $attribute = new AttributeDetail();
                            $attribute->fill($attributes);
                            $attribute->save();

                            if(!$productAttribute['amount']){
                                $productAttribute['amount'] = $attribute['number_'];
                                $productAttribute->save();
                            }

                            if(!$productAttribute['discount']){
                                $productAttribute['discount'] = $attribute['price_'];
                                $productAttribute->save();
                            }

                        }
                    }
                }
            }

        }
        return $this->sendResponse(true, 'success');
    }

public function delete($id)
    {
        $item = Product::findOrFail($id);
        $product_id = $item->id;

        $productAttribute = ProductAttribute::where('product_id',$product_id)->get();
        foreach ($productAttribute as $value) {
            $productAttribute_id = $value['id'];
            $attributes = AttributeDetail::where('product_attribute_id',$productAttribute_id)->get();
           foreach ($attributes as  $attribute) {
             $attribute->delete();
           }
        }
  
       
    foreach ($productAttribute as  $value) {
    $value->delete();
    }
        $item->delete();

        return $this->sendResponse(true, 'success');
    }
}
