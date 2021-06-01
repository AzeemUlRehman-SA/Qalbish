<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Deal;
use App\Models\DealService;
use App\Models\DealSubCategory;
use App\Models\DealSubCategoryAddon;
use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class DealController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $deals = Deal::orderBy('id', 'DESC')->get();

        return view('backend.deal.index', compact('deals'));
    }

    public function create()
    {
        $categories = Service::all();
        return view('backend.deal.create', compact('categories'));

    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:deals,slug',
            'net_price' => 'required',
            'price' => 'required',
//            'image' => 'required'
        ], [
            'net_price.required' => 'Net Price is required.',
            'price.required' => 'Price is required.',
//            'image.required' => 'Image is required.'
        ]);
        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $profile_image = $name;


            // for save original image
            $ImageUpload = Image::make($image->getRealPath());
            $originalPath = public_path('/uploads/packages/');
            // prevent possible upsizing

            $ImageUpload->resize(1140, 510);
            $ImageUpload->save($originalPath . $name);

            // for save thumnail image
            $ImageUploadThumbnail = Image::make($image->getRealPath());
            $thumbnailPath = public_path('/uploads/packages/thumbnails/');
            // prevent possible upsizing
            $ImageUploadThumbnail->resize(350, 262);
            $ImageUploadThumbnail = $ImageUploadThumbnail->save($thumbnailPath . $name);


            $ImageUploadThumbnailMobile = Image::make($image->getRealPath());
            // for save thumnail image
            $thumbnailMobilePath = public_path('/uploads/packages/thumbnails_mobiles/');
            // prevent possible upsizing
            $ImageUploadThumbnailMobile->resize(420, 420);
            $ImageUploadThumbnailMobile = $ImageUploadThumbnailMobile->save($thumbnailMobilePath . $name);

        } else {
            $profile_image = null;
        }

        $deal = Deal::create([
            'category_id' => $request->get('service_id'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'net_price' => (int)$request->get('net_price'),
            'total_price' => (int)$request->get('price'),
            'is_available' => $request->get('is_available'),
            'image' => $profile_image,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,

        ]);


        if (!empty($request->get('service_category_id'))) {
            foreach ($request->get('service_category_id') as $key => $ser_cat_id) {
                $service = DealService::create([
                    'deal_id' => $deal->id,
                    'service_category_id' => (int)$ser_cat_id
                ]);
                if (!empty($request->get('service_sub_category_id')[$ser_cat_id])) {
                    foreach ($request->get('service_sub_category_id')[$ser_cat_id] as $index => $ser_sub_cat_id) {
                        $service_sub_category = DealSubCategory::create([
                            'deal_service_category_id' => $service->id,
                            'sub_category_id' => (int)$ser_sub_cat_id
                        ]);
                        if (!empty($request->get('service_sub_category_addon_id')[$ser_cat_id][$ser_sub_cat_id])) {
                            foreach ($request->get('service_sub_category_addon_id')[$ser_cat_id][$ser_sub_cat_id] as $i => $ser_sub_cat_addon_id) {
                                $service_sub_category_addon = DealSubCategoryAddon::create([
                                    'deals_sub_category_id' => $service_sub_category->id,
                                    'addon_id' => (int)$ser_sub_cat_addon_id
                                ]);
                            }
                        }
                    }
                }
            }


//        $deal->sub_categories()->sync($request->get('sub_category_id'));

            return redirect()->route('admin.packages.index')
                ->with([
                    'flash_status' => 'success',
                    'flash_message' => 'Deal created successfully.'
                ]);
        }


    }

    public function edit($id)
    {
        $data['deal'] = Deal::with('deal_services')->find($id);
        $data['categories'] = Service::all();
        $data['services'] = Category::whereServiceId($data['deal']->category_id)->get();
        $data['serviceIds'] = DealService::whereDealId($id)->pluck('service_category_id')->toArray();
        $data['dealSubCategories'] = DealSubCategory::whereIn('deal_service_category_id', DealService::whereDealId($id)->pluck('id')->toArray())->pluck('sub_category_id')->toArray();
//        $data['dealSubCategoryAddons']      = DealSubCategoryAddon::whereIn('deals_sub_category_id', DealSubCategory::where('deal_service_category_id', DealService::whereDealId($id)->pluck('id')->toArray())->pluck('id')->toArray())->pluck('addon_id')->toArray();

        return view('backend.deal.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'slug'      => 'required',
            'net_price' => 'required',
            'price'     => 'required',
//            'image'     => 'nullable'
        ], [
            'net_price.required'    => 'Net Price is required.',
            'price.required'        => 'Price is required.',
        ]);

        $deal = Deal::with(['deal_services', 'deal_services.deal_sub_categories', 'deal_services.deal_sub_categories.deal_sub_category_addons'])->findOrFail($id);

        if ($request->has('image')) {

            $image          = $request->file('image');
            $name           = $image->getClientOriginalName();
            $profile_image  = $name;


            // for save original image
            $ImageUpload    = Image::make($image->getRealPath());
            $originalPath   = public_path('/uploads/packages/');
            // prevent possible upsizing

            $ImageUpload->resize(1140, 510);
            $ImageUpload->save($originalPath . $name);

            // for save thumnail image
            $ImageUploadThumbnail   = Image::make($image->getRealPath());
            $thumbnailPath          = public_path('/uploads/packages/thumbnails/');
            // prevent possible upsizing
            $ImageUploadThumbnail->resize(350, 262);
            $ImageUploadThumbnail = $ImageUploadThumbnail->save($thumbnailPath . $name);


            $ImageUploadThumbnailMobile = Image::make($image->getRealPath());
            // for save thumnail image
            $thumbnailMobilePath        = public_path('/uploads/packages/thumbnails_mobiles/');
            // prevent possible upsizing
            $ImageUploadThumbnailMobile->resize(420, 420);
            $ImageUploadThumbnailMobile = $ImageUploadThumbnailMobile->save($thumbnailMobilePath . $name);

        } else {
            $profile_image = $deal->image;
        }

        $deal->update([
            'category_id'       => $request->get('service_id'),
            'name'              => $request->get('name'),
            'slug'              => $request->get('slug'),
            'net_price'         => (int)$request->get('net_price'),
            'total_price'       => (int)$request->get('price'),
            'is_available'      => $request->get('is_available'),
            'image'             => $profile_image,
            'meta_title'        => $request->meta_title,
            'meta_description'  => $request->meta_description,
            'meta_keywords'     => $request->meta_keywords,

        ]);


        foreach ($deal->deal_services as $deal_service){
            foreach ($deal_service->deal_sub_categories as  $deal_sub_category){
                foreach ($deal_sub_category->deal_sub_category_addons as $deal_sub_category_addon){
                    $deal_sub_category_addon->delete();
                }
            }
        }

        foreach ($deal->deal_services as $deal_service){
            foreach ($deal_service->deal_sub_categories as  $deal_sub_category){
                $deal_sub_category->delete();
            }
        }

        $deal->deal_services()->delete();


        if (!empty($request->get('service_category_id'))) {
            foreach ($request->get('service_category_id') as $key => $ser_cat_id) {
                $service = DealService::create([
                    'deal_id'               => $deal->id,
                    'service_category_id'   => (int)$ser_cat_id
                ]);
                if (!empty($request->get('service_sub_category_id')[$ser_cat_id])) {
                    foreach ($request->get('service_sub_category_id')[$ser_cat_id] as $index => $ser_sub_cat_id) {
                        $service_sub_category           = DealSubCategory::create([
                            'deal_service_category_id'  => $service->id,
                            'sub_category_id'           => (int)$ser_sub_cat_id
                        ]);
                        if (!empty($request->get('service_sub_category_addon_id')[$ser_cat_id][$ser_sub_cat_id])) {
                            foreach ($request->get('service_sub_category_addon_id')[$ser_cat_id][$ser_sub_cat_id] as $i => $ser_sub_cat_addon_id) {
                                $service_sub_category_addon = DealSubCategoryAddon::create([
                                    'deals_sub_category_id' => $service_sub_category->id,
                                    'addon_id' => (int)$ser_sub_cat_addon_id
                                ]);
                            }
                        }
                    }
                }
            }


//        $deal->sub_categories()->sync($request->get('sub_category_id'));

            return redirect()->route('admin.packages.index')
                ->with([
                    'flash_status' => 'success',
                    'flash_message' => 'Deal created successfully.'
                ]);
        }

    }

    public function destroy($id)
    {
        $deal = Deal::findOrFail($id);

        $deal->delete();

        return redirect()->route('admin.packages.index')
            ->with([
                'flash_status' => 'success',
                'flash_message' => 'Deal has been deleted'
            ]);
    }
}
