@extends('main')

@section('title','Update Profile')


@section('content')
    <div class="flex">
        <x-sidebar/>

        <div class="relative bg-white min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative items-center w-full" >



            <div class=" space-y-8 p-10 bg-white rounded-xl shadow-lg z-10 w-[70%] mx-auto">
                @if($msg = \Illuminate\Support\Facades\Session::get('success'))
                    <div class="bg-green-500 w-[50%] text-white font-medium h-[70px] rounded-lg px-[2.5%] py-[0.5rem] flex items-center justify-center">
                        <p>{{$msg}}</p>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="w-[50%] bg-red-300 font-medium text-red-700 rounded-lg px-[2.5%] py-[0.5rem]">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="grid  gap-8 grid-cols-1">
                    <div class="flex flex-col ">
                        <div class="flex flex-col sm:flex-row items-center">
                            <h2 class="font-semibold text-lg mr-auto">Passenger Infos :</h2>
                            <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
                        </div>
                        <div class="mt-5">
                            <form action="{{route('updatePassenger')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form">
                                    <div class="md:space-y-2 mb-3">
                                        <label class="text-xs font-semibold text-gray-600 py-2">Passenger Profile<abbr class="hidden" title="required">*</abbr></label>
                                        <div class="flex items-center py-6">
                                            <div class="w-[70px] h-[70px] mr-4 flex-none rounded-full border overflow-hidden">
                                                <img class="w-[70px] h-[70px] rounded-full mr-4 object-cover" id="currentImage" src="{{asset('images/'.$user->image)}}" alt="Avatar Upload">
                                            </div>
                                            <label class="cursor-pointer ">
                                                <span class="focus:outline-none text-white text-sm py-2 px-4 rounded-full bg-violet-400 hover:bg-violet-600 hover:shadow-lg">Change Picture</span>
                                                <input type="file" class="hidden" id="newImage" name="image">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                                        <div class="mb-3 space-y-2 w-full text-xs">
                                            <label class="font-semibold text-gray-600 py-2">Name <abbr title="required">*</abbr></label>
                                            <input placeholder="Passenger Name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" name="name" value="{{$user->name}}">
                                        </div>
                                        <div class="mb-3 space-y-2 w-full text-xs">
                                            <label class="font-semibold text-gray-600 py-2">Email <abbr title="required">*</abbr></label>
                                            <input placeholder="Passenger Email" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" name="email" value="{{$user->email}}">
                                        </div>
                                    </div>



                                    <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                                        <button type="submit" class="mb-2 md:mb-0 bg-violet-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-violet-600">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>


@endsection
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('newImage').addEventListener('change', function() {
                    let file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            document.getElementById('currentImage').src = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
