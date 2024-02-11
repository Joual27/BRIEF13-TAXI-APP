@extends('main')

@section('title','Login')

@section('content')

    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center items-center">
        <div class="max-w-screen-xl h-[70vh] sm:m-10 bg-white rounded-lg shadow sm: flex justify-center flex-1">
            <div class="mt-[4rem] lg:w-1/2 xl:w-5/12 p-6 sm:p-12">

                @if($msg = \Illuminate\Support\Facades\Session::get('success'))
                    <div class="bg-green-500 w-[80%] rounded-lg px-[2.5%] py-[1rem] mx-auto text-white font-medium h-[50px] flex justify-center items-center mb-[1rem]">
                        <p>{{$msg}}</p>
                    </div>
                @endif
                    @if($msg = \Illuminate\Support\Facades\Session::get('login_error'))
                        <div class="bg-red-500 w-[80%] rounded-lg px-[2.5%] py-[1rem] mx-auto text-white font-medium h-[50px] flex justify-center items-center mb-[1rem]">
                            <p>{{$msg}}</p>
                        </div>
                    @endif
                <div>
                    <p class="text-center text-violet-400 font-bold text-[1.25rem]">TAXI-APP-X</p>
                </div>
                <div class="mt-12 flex flex-col items-center">
                    <h1 class="text-2xl xl:text-2xl font-bold">
                        Sign In
                    </h1>
                    <div class="w-full flex-1 mt-8">
                        <form action="{{route('loginOperation')}}" method="POST" >
                            @csrf
                            <div class="mx-auto max-w-xs">

                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                    type="text" placeholder="Email Or Username"
                                    id= "email"
                                    name="email"
                                />


                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    id= "pw"
                                    name="password"
                                    type="password" placeholder="Password"/>


                                <a href="{{route('register')}}">
                                    <p class="underline text-gray-500 mt-[0.75rem]">Don't have an account ? create One</p>
                                </a>
                                <button type="submit"
                                        class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                    <span class="ml-3">
                                        Sign In
                                    </span>
                                </button>
                                <span id="formError" class="text-red-500 font-medium mt-[0.75rem]"></span>
                                <a href="" class="text-center"><p class="underline text-gray-500 mt-[1rem]">Back To Home Page</p> </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex-1 bg-indigo-100 text-center hidden lg:flex">
                <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat"
                     style="background-image: url('https://storage.googleapis.com/devitary-image-host.appspot.com/15848031292911696601-undraw_designer_life_w96d.svg');">
                </div>
            </div>
        </div>
    </div>
@endsection
