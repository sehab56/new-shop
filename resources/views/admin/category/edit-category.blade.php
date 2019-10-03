@extends('admin.master')

@section('title')
 Edit Category
@endsection

@section('body')
    <br/>
    <br/>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">

                    <h3 class="text-center text-success">{{ Session('message') }}</h3>
                    <form action="{{ route('update-category') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-3">Category Name</label>
                            <div class="col-md-9">
                                <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control"/>
                                <input type="hidden" name="category_id" value="{{ $category->id }}" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Category Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="category_description">{{ $category->category_name }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Publication status</label>
                            <div class="col-md-9">

                                <label><input type="radio" {{ $category->category_name == 1 ? 'checked' : '' }} name="publication_status" value="1"/> Published</label>
                                <label><input type="radio" {{ $category->category_name == 0 ? 'checked' : '' }} name="publication_status" value="0"/> Unpublished</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <input type="submit" name="btn" value="Update Category Info" class="btn btn-success btn-block"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
