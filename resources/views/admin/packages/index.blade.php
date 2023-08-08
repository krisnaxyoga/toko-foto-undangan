@extends('layouts.admin')
@section('title', 'packages')
@section('content')
<section>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>packages</h2>
                </div>
                <div class="card-body">
                    <a href="{{ route('packages.create') }}" class="btn btn-primary mb-2">add</a>
                    {{-- <a href="{{ route('excel.packages') }}" class="btn btn-success mb-2">Download Excel</a> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    {{-- <th>category name</th> --}}
                                    <th>name of packages</th>
                                    <th>image</th>
                                    <th>description</th>
                                    <th>price</th>
                                    <th>active</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    {{-- <td>{{ $item->categorypackage->name }}</td> --}}
                                    <td>{{ $item->name }}</td>
                                    <td><img src="/images/{{ $item->image }}" width="100"/></td>
                                    <td class="elipsis">{{ $item->description }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        @if($item->is_active == 1)
                                        <p class="text-success">active</p>
                                        @else
                                        <p class="text-danger">full</p>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('packages.edit',$item->id) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></a>

                                        <form class="d-inline" action="{{route('packages.destroy', $item->id)}}" method="POST" onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>


                                        <a href="{{ route('fullbook.paket',$item->id) }}" class="btn btn-warning mr-2">full</a>


                                        <a href="{{ route('activebook.paket',$item->id) }}" class="btn btn-success mr-2">active</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
