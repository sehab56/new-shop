
@extends('admin.master')

@section('title')
    Add Product
@endsection

@section('body')
    <br/>
    <br/>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">

                    <h3 class="text-center text-success">{{ Session('message') }}</h3>
                    <form action="{{ route('update-product') }}" method="POST" class="form-horizontal" enctype="multipart/form-data" name="editProductform">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-3">Category Name</label>
                            <div class="col-md-9">
                                <select class="form-control" name="category_id">
                                    <option>---Select Category Name---</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->has('category_id')  ?$errors->first('category_id') : ''}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Brand Name</label>
                            <div class="col-md-9">
                                <select class="form-control" name="brand_id">
                                    <option>---Select Brnad Name---</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->has('brand_id')  ?$errors->first('brand_id') : ''}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Product Name</label>
                            <div class="col-md-9">
                                <input type="text" name="product_name" value="{{ $product->product_name }}"  class="form-control"/>
                                <input type="hidden" name="id" value="{{ $product->id }}"  class="form-control"/>
                                <span class="text-danger">{{ $errors->has('product_name')  ?$errors->first('product_name') : ''}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Product Price</label>
                            <div class="col-md-9">
                                <input type="number" name="product_price" value="{{ $product->product_price }}"  class="form-control"/>
                                <span class="text-danger">{{ $errors->has('product_price')  ?$errors->first('product_price') : ''}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Product Quantity</label>
                            <div class="col-md-9">
                                <input type="number" name="product_quantity" value="{{ $product->product_quantity }}"  class="form-control"/>
                                <span class="text-danger">{{ $errors->has('product_quantity')  ?$errors->first('product_quantity') : ''}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Short Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="short_description">{{ $product->short_description }}</textarea>
                                <span class="text-danger">{{ $errors->has('short_description')  ?$errors->first('short_description') : ''}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Long Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="editor" name="long_description">{{ $product->long_description }}</textarea>
                                <span class="text-danger">{{ $errors->has('long_description')  ?$errors->first('long_description') : ''}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Product Image</label>
                            <div class="col-md-9">
                                <input type="file" name="product_image" value="{{ $product->product_image }}" accept="image/*"/>
                                <br/>
                                <img src="{{ asset($product->product_image) }}" alt="" height="80" width="90">
                                <span class="text-danger">{{ $errors->has('product_image')  ?$errors->first('product_image') : ''}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Publication status</label>
                            <div class="col-md-9">

                                <label><input type="radio" {{ $product->publication_status == 1 ? 'checked' : '' }} name="publication_status" value="1"/> Published</label>
                                <label><input type="radio" {{ $product->publication_status == 0 ? 'checked' : '' }} name="publication_status" value="0"/> Unpublished</label><br/>
                                <span class="text-danger">{{ $errors->has('publication_status')? $errors->first('publication_status'): '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <input type="submit" name="btn" value="Edit Product Info" class="btn btn-success btn-block"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.forms['editProductform'].elements['category_id'].value='{{ $product->category_id }}';
        document.forms['editProductform'].elements['brand_id'].value='{{ $product->brand_id }}';
    </script>
@endsection