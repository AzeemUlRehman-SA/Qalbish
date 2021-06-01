@extends('layouts.master')
@section('title','Memberships')
@section('content')


    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('Membership') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post"
                              action="{{ route('admin.memberships.update', $membership->id) }}"
                              enctype="multipart/form-data" role="form">
                            @csrf
                            @method('patch')
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">


                                    <div class="form-group row">
                                        <div class="col-md-12">

                                            <label for="title"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Title') }}</label>
                                            <input id="title" type="text"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   name="title"
                                                   value="{{ ($membership) ? $membership->title : '' }}"
                                                   autocomplete="title" autofocus>

                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">


                                            <label for="description"
                                                   class="col-md-4 col-form-label text-md-left"></label>

                                            <textarea name="description" id="description" rows="10" cols="80"
                                                      required>{{ ($membership) ? $membership->description : '' }}</textarea>

                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>


                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit text-md-right">
                                <div class="m-form__actions m-form__actions">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('SAVE') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endpush


public function __construct()
{
$this->middleware('role:admin');
}

public function index()
{
$testimonials = Testimonial::all();

return view('backend.testimonial.index', compact('testimonials'));
}

public function create()
{
return view('backend.testimonial.create');
}

public function store(Request $request)
{
$this->validate($request, [
'title' => 'required|string',
'description' => 'required|string',
'image' => 'required|mimes:png,jpg,jpeg,pdf',

], [
'title.required' => 'Title  is required.',
'description.required' => 'Description  is required.',
'image.required' => 'Image  is required.',

]);
if ($request->has('image')) {
$image = $request->file('image');
$name = $image->getClientOriginalName();
$destinationPath = public_path('/uploads/testimonials');
$imagePath = $destinationPath . "/" . $name;
$image->move($destinationPath, $name);
$profile_image = $name;
} else {
$profile_image = null;
}
Testimonial::create([
'title' => $request->get('title'),
'description' => $request->get('description'),
'image' => $profile_image
]);


return redirect()->route('admin.testimonial.index')
->with([
'flash_status' => 'success',
'flash_message' => 'Testimonial created successfully.'
]);
}

public function edit($id)
{
$testimonial = Testimonial::find($id);

return view('backend.testimonial.edit', compact('testimonial'));


}

public function update(Request $request, $id)
{
$this->validate($request, [
'title' => 'required|string',
'description' => 'required|string',


], [
'title.required' => 'Title  is required.',
'description.required' => 'Description  is required.',

]);
$testimonial = Testimonial::find($id);
if ($request->has('image')) {
$image = $request->file('image');
$name = $image->getClientOriginalName();
$destinationPath = public_path('/uploads/testimonials');
$imagePath = $destinationPath . "/" . $name;
$image->move($destinationPath, $name);
$profile_image = $name;
} else {
$profile_image = $testimonial->profile_pic;
}



$testimonial->update([
'title' => $request->get('title'),
'description' => $request->get('description'),
'image' => $profile_image
]);
return redirect()->route('admin.testimonial.index')
->with([
'flash_status' => 'success',
'flash_message' => 'Testimonial updated successfully.'
]);
}

public function destroy($id)
{
$testimonial = Testimonial::findOrFail($id);
$testimonial->delete();

return redirect()->route('admin.testimonial.index')
->with([
'flash_status' => 'success',
'flash_message' => 'Testimonial has been deleted.'
]);
}