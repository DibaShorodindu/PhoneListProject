<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="" />
    <meta
            name="keywords"
            content="phone number list, mobile number list, sales leads, mobile leads, data prospect, sales crm, contact database, contact details"
    />

    <title>You | Phone List</title>


    <!-- Bootstrap CSS -->
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
    />

    <!-- Bootstrap Icons -->
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
    />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap"
            rel="stylesheet"
    />

    <!-- Animate CSS -->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}adminAsset/assets/css/style.css" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}adminAsset/assets/images/icons/favicon.ico" />

</head>

<body>
<header>
    <!-- START NAVBAR -->
    <nav
            class="navbar navbar--user navbar-expand-md navbar-light"
            id="user-nav"
    >
        <div class="container-fluid justify-content-end">
            <a class="navbar-brand" href="{{ route('/') }}">
                <img
                        class="img-fluid"
                        src="{{ asset('/') }}adminAsset/assets/images/logo.svg"
                        alt="phone list"
                />
            </a>

            <button
                    class="navbar-toggler me-auto"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
            >
                <i class="bi bi-list"></i>
            </button>
            <div
                    class="collapse navbar-collapse justify-content-between"
                    id="navbarSupportedContent"
            >
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item pl-4">
                        <a class="nav-link {{  request()->routeIs('loggedInUser') ? 'active' : '' }}" aria-current="page" href="{{ route('loggedInUser') }}">
                            <i class="bi bi-house-door"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item" id="search">
                        <a class="nav-link {{  request()->routeIs('people') ? 'active' : '' }}" href="{{ route('people') }}">
                            <i class="bi bi-search"></i>
                            Data Search
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{  request()->routeIs('upgrade') ? 'active' : '' }}" href="{{ route('upgrade') }}">
                            <i class="bi bi-box-seam"></i>
                            Products
                        </a>
                    </li>
                </ul>
            </div>

            <!-- START SHOW ELEMENT ON CLICKING USER -->
            <div class="user-div hide u-box-shadow-1">
                <h4 class="px-4 pt-5"></h4>
                <div class="user--label mx-4">
                    <span>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                </div>

                <div class="user--menu">
                    <a class="user--menu-item" href="{{ route('account') }}">
                        <i class="bi bi-gear"></i>
                        <span>Settings</span>
                    </a>
                    <a class="user--menu-item" href="{{ route('upgrade') }}">
                        <i class="bi bi-trophy"></i>
                        <span>Upgrade Plan</span>
                    </a>

                    <a class="user--menu-item mb-3" href="{{ route('userLogout') }}">
                        <i class="bi bi-power"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
            <!-- END SHOW ELEMENT ON CLICKING USER -->
        </div>

        <!-- START RIGHT NAV ITEMS -->
        <div class="d-flex align-items-center nav-right__box">
            <a class="btn btn-purple mx-4" href="{{ route('upgrade') }}"
            >Get unlimited leads
            </a>
            <button type="button" class="btn">
                <a href="#">
                    <i class="bi bi-telephone phone-btn"></i>
                </a>
            </button>

            <!-- Link to Blog site -->
            <a class="btn" href="http://help.phonelist.io/">
                <i class="bi bi-question-circle"></i>
            </a>

            <button type="button" class="btn notification-btn">
                <i class="bi bi-bell"></i>
            </button>
            <button
                    type="button"
                    id="userBtn"
                    class="user user-btn circle-element mx-3"
            >

                <p class="user-name">{{ $firstStringCharacter = substr(Auth::user()->firstName, 0, 1) }}{{ $firstStringCharacter = substr(Auth::user()->lastName, 0, 1) }}</p>
            </button>
        </div>
        <!-- END RIGHT NAV ITEMS -->
    </nav>
    <!-- END NAVBAR -->

    <!-- START SHOW WHEN CLICKED ON NOTIFICATION -->
    <div
            class="u-box-shadow-1 notification__sidebar hide animate__animated animate__fadeInRightBig"
    >
        <div class="notification--header">
            <div class="notification--header-title">
                <h5>NOTIFICATIONS</h5>
            </div>
            <div class="notification--header-icons">
                <div class="btn"><i class="bi bi-arrow-clockwise"></i></div>
                <div class="btn close-btn">
                    <i class="bi bi-x-lg"></i>
                </div>
            </div>
        </div>
        <div class="notification--body"></div>
    </div>
    <!-- END SHOW WHEN CLICKED ON NOTIFICATION -->

</header>

<main id="peopleData">
    <section class="section-user-dashboard">
        <!-- START SIDEBAR -->
        <section class="section-user-dashboard--sidebar">
            <div class="heading--sub py-3 ps-4 u-border-bottom">Filters</div>

            <!-- INPUT NAME -->
            <div class="input-name u-border-bottom py-4 px-4">
                <div class="input-name--title pb-2">
                    <i class="bi bi-person-badge pe-2"></i>
                    Name
                </div>
                <form id="search" action="{{ route('peopleSearch') }}">
                    <input
                            type="text"
                            id='searchPeopleFromPhoneList'
                            name="name"
                            onkeypress="handle"
                            placeholder="Enter name..."
                    />
                </form>


            </div>

            <!-- INPUT GENDER -->
            <div class="input-gender u-border-bottom py-4 px-4">
                <div class="input-gender--title pb-2">
                    <i class="bi bi-gender-ambiguous pe-2"></i>
                    Gender
                </div>
                <form id="searchGender" action="{{ route('genderSearch') }}">
                    <input
                            type="text"
                            name="gender"
                            id="gender"
                            placeholder="Enter gender..."
                            onkeypress="handleGender"
                    />
                </form>

            </div>

            <!-- INPUT RELATIONSHIP STATUS -->
            <div class="input-relationship u-border-bottom py-4 px-4">
                <div class="input-relationship--title pb-2">
                    <i class="bi bi-heart-fill pe-2"></i>
                    Relationship Status
                </div>
                <form id="searchrelationship" action="{{ route('relationshipSearch') }}">
                    <input
                            type="text"
                            name="relationship"
                            id="relationship"
                            placeholder="Enter relationship status..."
                            onkeypress="handlerelationship"
                    />
                </form>
            </div>

            <!-- INPUT CURRENT ADDRESS -->
            <div class="input-currentAdd u-border-bottom py-4 px-4">
                <div class="input-currentAdd--title pb-2">
                    <i class="bi bi-pin-map-fill"></i>
                    Current Address
                </div>
                <form id="searchLocation" action="{{ route('locationSearch') }}">
                    <input
                            type="text"
                            name="location"
                            id="location"
                            placeholder="Enter current address..."
                            onkeypress="handlelocation"
                    />
                </form>
            </div>

            <!-- INPUT HOMETOWN -->
            <div class="input-hometown u-border-bottom py-4 px-4">
                <div class="input-hometown--title pb-2">
                    <i class="bi bi-house-door-fill"></i>
                    Hometown
                </div>
                <form id="searchHometown" action="{{ route('hometownSearch') }}">
                    <input
                            type="text"
                            name="hometown"
                            id="hometown"
                            placeholder="Enter hometown..."
                            onkeypress="handlehometown"
                    />
                </form>
            </div>

            <!-- INPUT COUNTRY -->
            <div class="input-country py-4 px-4">
                <div class="input-country--title pb-2">
                    <i class="bi bi-globe2 pe-2"></i>
                    Country
                </div>
                <form id="searchCountry" action="{{ route('countrySearch') }}">
                    <input
                            type="text"
                            name="country"
                            id="country"
                            placeholder="Enter country..."
                            onkeypress="handlecountry"
                    />
                </form>
            </div>

            <!-- TODO Remove if unused -->
            <!-- INPUT JOB TITLE -->
            <!-- <div class="input-job u-border-bottom py-4 px-4">
                  <div class="input-job--title pb-4">
                    <i class="bi bi-briefcase pe-2"></i>
                    Job Title
                  </div>
                  <input type="text" name="job" id="job" placeholder="Search for a job title" />
                  <ul id="jobList" class="jobList hide">
                    <li>software engineer</li>
                    <li>project manager</li>
                    <li>teacher</li>
                    <li>owner</li>
                    <li>student</li>
                  </ul>
                </div> -->
        </section>
        <!-- END SIDEBAR -->

        <!-- START MAIN DASHBOARD -->
        <section class="section-user-dashboard--main">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 d-flex align-items-end ps-5">
                        <input id="checkAll" type="button" class="selectAll" value="Select All"/>
                    </div>
                    <form action="{{ route('customExport') }}" enctype="multipart/form-data" method="get">
                        @csrf
                        <input hidden type="number" name="userId" value="{{ Auth::user()->id }}">
                        <div class="col-md-3 offset-7 d-flex justify-content-end mt-4">
                            <button type="submit" id="customCSV" class="btn btn-download border-3">
                                <i class="bi bi-download"></i>
                                &nbsp; Download Data CSV
                            </button>
                        </div>
                        <!-- START TABLE -->
                        <div
                                class="section-table table-scrollable mx-5 mt-5 mb-2"
                                style="width: 75vw; overflow: auto; max-height: 85vh"
                        >
                            <div class="container">
                                <div class="row">
                                    <table
                                            class="table table-hover table-bordered table-responsive list"
                                            id="peopleTable"
                                    >
                                        <thead>
                                        <tr>
                                            <th>



                                            </th>

                                            <th>Name</th>
                                            <th>Facebook Profile</th>
                                            <th>Quick Actions</th>
                                            <th>Gender</th>
                                            <th>Relationship Status</th>
                                            <th>Work Place</th>
                                            <th>Last Education Year</th>
                                            <th>Current Address</th>
                                            <th>Home Town</th>
                                            <th>Country</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($allData as $data)
                                            <tr class="table-row">
                                                <td>
                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="{{$data->id}}" >
                                                </td>
                                                <td>
                                                    <a href="{{ route('user', ['id' => $data->id ]) }}" class="person-name">
                                                        {{ $data->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a
                                                            href="https://www.facebook.com/{{ $data->uid }}"
                                                    >https://www.facebook.com/{{ $data->uid }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-access btn-access--phone"
                                                            {{--id="accessBtn"--}}
                                                            id="{{ $data->id }}"
                                                            onclick="accessPhoneNumber({{ $data->id }})"
                                                    >
                                                        Access Phone Number
                                                    </button>
                                                    <div class="message-box hide-text">
                                                        Verified number costs one credit.
                                                    </div>

                                                    <div class="button-group hide" id="buttonGroup{{ $data->id }}">
                                                        <a
                                                                class="btn btn-access btn-access--phone"
                                                                href="{{ route('upgrade') }}"
                                                        >
                                                            <i class="bi bi-phone"></i>
                                                            <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                        <div
                                                                class="message-box message-box--phone hide-text"
                                                                id="messagePhone{{ $data->id }}"
                                                        >
                                                        </div>

                                                        <a
                                                                class="btn btn-access btn-access--email"
                                                                href="{{ route('upgrade') }}"
                                                        >
                                                            <i class="bi bi-envelope"></i>
                                                            <i class="bi bi-caret-down-fill"></i>
                                                        </a>

                                                        <div
                                                                class="message-box message-box--email hide-text"
                                                                id="messageEmail{{ $data->id }}"
                                                        >
                                                            <!-- Email not available -->
                                                        </div>
                                                    </div>
                                                    {{--<a
                                                        class="btn btn-access btn-access--phone"
                                                        href="{{ route('packages') }}"
                                                    >
                                                        <i class="bi bi-phone"></i>
                                                        <i class="bi bi-caret-down-fill"></i>
                                                    </a>
                                                    <a
                                                        class="btn btn-access btn-access--email"
                                                        href="{{ route('packages') }}"
                                                    >
                                                        <i class="bi bi-envelope"></i>
                                                        <i class="bi bi-caret-down-fill"></i>
                                                    </a>--}}
                                                </td>
                                                <td>
                                                    @if(!empty($data->gender))
                                                        {{ $data->gender}}
                                                    @else
                                                        -
                                                    @endif</td>
                                                <td>
                                                    @if(!empty( $data->relationship_status ))
                                                        {{ $data->relationship_status }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty( $data->work ))
                                                        {{ $data->work}}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty( $data->education_last_year ))
                                                        {{ $data->education_last_year}}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty( $data->location ))
                                                        {{ $data->location.', '.$data->country }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty( $data->hometown ))
                                                        {{ $data->hometown }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty( $data->country ))
                                                        {{ $data->country }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END TABLE -->

            <!-- START PAGINATION -->
            <div class="row pb-2 pt-5 mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <div class="d-sm-inline-flex justify-content-center">
                                {!! $allData->links() !!}
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- END PAGINATION -->
        </section>
        <!-- END MAIN DASHBOARD -->
    </section>

</main>

<!-- Bootstrap JS -->
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
></script>

<!-- jQuery -->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {

        $(document).on('click', '#checkAll', function() {

            if ($(this).val() == 'Select All') {
                //$('.button input').prop('checked', true);
                var ele=document.getElementsByName('chk[]');
                for(var i=0; i<ele.length; i++){
                    if(ele[i].type=='checkbox')
                        ele[i].checked=true;
                }
                $(this).val('Deselect All');
            } else {
                //$('.button input').prop('checked', false);
                var ele=document.getElementsByName('chk[]');
                for(var i=0; i<ele.length; i++){
                    if(ele[i].type=='checkbox')
                        ele[i].checked=false;

                }
                $(this).val('Select All');
            }
        });

    });
</script>

<script>
    function handle(e){
        if(e.key === "Enter"){
            alert("Enter was just pressed.");
        }

        return false;
    }
    function handleGender(e){
        if(e.key === "Enter"){
            alert("Enter was just pressed.");
        }

        return false;
    }
    function handlerelationship(e){
        if(e.key === "Enter"){
            alert("Enter was just pressed.");
        }

        return false;
    }
    function handlelocation(e){
        if(e.key === "Enter"){
            alert("Enter was just pressed.");
        }

        return false;
    }
    function handlehometown(e){
        if(e.key === "Enter"){
            alert("Enter was just pressed.");
        }

        return false;
    }
    function handlecountry(e){
        if(e.key === "Enter"){
            alert("Enter was just pressed.");
        }

        return false;
    }

    /*$(function(){
        $('#customCSV').click(function(){
            var val = [];
            $(':checkbox:checked').each(function(i){
                val[i] = $(this).val();
            });
            //alert(val);
            var selected_values = val;
            $.ajax({
                type: "GET",
                url: "{{--{{ route('exportOption.Userscsv') }}--}}",
                    cache: false,
                    data: {id: selected_values},
                    success: function() {
                        let _url = $("#export_records").data('href');
                        //var selected_values = val;
                        //window.location.href = _url + '?user_id=' + selected_values;

                    }
                });
            });

        });*/

</script>

/* Access Phone Number */

<script type="text/javascript">
    let collection,  buttonGroup, messageBox, buttonId;

    messageBox = document.getElementById('message');

    function accessPhoneNumber(id)
    {
        collection = document.getElementById(id);
        buttonGroup = document.getElementById('buttonGroup'+id);
        buttonId = document.getElementById(id).value;
        collection.classList.add('hide');
        buttonGroup.classList.remove('hide');

        $.ajax({
            url:"{{ route('peopleDataHistory') }}",
            method:"POST",
            data:{id:id, _token:"{{ csrf_token() }}"},
            dataType:"json",
            success:function(data)
            {
                for(var count = 0; count < data.length; count++)
                {
                    $("#messagePhone"+id).text(data[count].phone);
                    if (data[count].email != null)
                        $("#messageEmail"+id).text(data[count].email);
                    else
                        $("#messageEmail"+id).text("N/A");
                }
            }
        })

    }

</script>



<!-- TODO Remove if unused -->
<!-- JOB TITLE FILTER -->
<!-- <script>
$(document).ready(function () {
  $('#job').on('keyup', function () {
    var value = $(this).val().toLowerCase();
    $('#jobList li').filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});
</script> -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="{{ asset('public/js/accessPhone.js') }}" defer></script>

<!-- Custom JS -->
<script src="{{ asset('/') }}adminAsset/assets/js/navbar.js"></script>
<script src="{{ asset('/') }}adminAsset/assets/js/people.js"></script>
<script src="{{ asset('/') }}adminAsset/assets/js/script.js"></script>



</body>
</html>





