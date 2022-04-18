@extends('userDashboard.settings.master')

@section('main')
    <section class="section-main">
        <div class="card u-box-shadow-2 m-4 border rounded-3">
            {{--<form action="--}}{{--{{ route('updateUserInfo', ['id' => Auth::user()->id]) }}--}}{{--" id="personalInfo" method="post" enctype="multipart/form-data">
                @csrf--}}
                <div class="card-title d-flex align-items-center justify-content-between">
                    <h1 class="p-4 text-capitalize">Account Info</h1>
                    <button type="button" class="btn btn-purple me-3" onclick="saveFunction()">Save</button>
                </div>
                <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4">
                                <input hidden type="text" class="form-control" id="id" name="id" value="{{ Auth::user()->id }}"/>
                                <form action="{{ route('updateUserFirstName', ['id' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName" name="firstName" value="{{ Auth::user()->firstName }}" onkeypress="handleFirstName" />
                                        </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                            <form action="{{ route('updateUserLastName', ['id' => Auth::user()->id]) }}"  method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="mb-3">
                                        <label for="lname" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" value="{{ Auth::user()->lastName }}" onkeypress="handleLastName"/>
                                    </div>
                            </form>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="{{ route('updateUserPhone', ['id' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="mb-3">
                                        <label for="number" class="form-label"
                                        >Phone Number</label
                                        >
                                        <input type="number" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" onkeypress="handlePhone"/>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('updateUserCountry', ['id' => Auth::user()->id]) }}" id="personalInfo" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="country" name="country" value="{{ Auth::user()->country }}" onkeypress="handleCountry"/>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <span class="form-span d-block" id="email"
                                        >{{ Auth::user()->email }}</span
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <button
                                        type="button"
                                        class="btn btn-change mt-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#changeEmail"
                                    >
                                        <i class="bi bi-shield-lock"></i>
                                        Change Email
                                    </button>

                                    <!-- Modal -->
                                    <div
                                        class="modal fade"
                                        id="changeEmail"
                                        tabindex="-1"
                                        aria-labelledby="changeEmail"
                                        aria-hidden="true"
                                    >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="changeEmail">
                                                        Change Email
                                                    </h3>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                </div>
                                                <form action="{{ route('updateUserEmail', ['id' => Auth::user()->id]) }}" id="personalInfo" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label"
                                                                >New Email:</label
                                                                >
                                                                <input type="email" class="form-control" name="email" />
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">
                                                            Change Email
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="password" class="form-label">Password</label>
                                </div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <button
                                        type="button"
                                        class="btn btn-change"
                                        data-bs-toggle="modal"
                                        data-bs-target="#changePassword"
                                    >
                                        <i class="bi bi-shield-lock"></i>
                                        Change Password
                                    </button>

                                    <!-- Modal -->
                                    <div
                                        class="modal fade"
                                        id="changePassword"
                                        tabindex="-1"
                                        aria-labelledby="changePassword"
                                        aria-hidden="true"
                                    >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="changePassword">
                                                        Change Password
                                                    </h3>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                </div>
                                                <form action="{{ route('updateUserPassword', ['id' => Auth::user()->id]) }}"  method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label"
                                                                >New Password:</label
                                                                >
                                                                <input type="password" class="form-control" name="password" />
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">
                                                            Change Password
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            {{--</form>--}}

        </div>
        </div>
    </section>


    <script>

        function handleFirstName(e){
            if(e.key === "Enter"){
                alert("Enter was just pressed.");
            }

            return false;
        }
        function handleLastName(e){
            if(e.key === "Enter"){
                alert("Enter was just pressed.");
            }

            return false;
        }
        function handlePhone(e){
            if(e.key === "Enter"){
                alert("Enter was just pressed.");
            }

            return false;
        }
        function handleCountry(e){
            if(e.key === "Enter"){
                alert("Enter was just pressed.");
            }

            return false;
        }
        function saveFunction(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = document.getElementById("id").value;
            var firstName = document.getElementById("firstName").value;
            var lastName = document.getElementById("lastName").value;
            var phone = document.getElementById("phone").value;
            var country = document.getElementById("country").value;
            //alert(id);
            $.ajax({
                type: "POST",
                url: '{{ route('updateUserInfo') }}',
                data: { firstName:firstName, lastName:lastName, phone:phone, country:country, id:id },
                success: function( msg ) {
                    alert( msg );
                }
            });
        }



    </script>

@endsection
