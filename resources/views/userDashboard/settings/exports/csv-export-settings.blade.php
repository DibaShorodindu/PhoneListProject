@extends('userDashboard.settings.master')

@section('main')
    <section class="section-main">
        <!-- START SECOND NAVBAR -->
        <section class="second-navbar">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="{{ route('exports') }}" class="nav-link {{  request()->routeIs('exports') ? 'active' : '' }}">CSV Exports</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('csv-export-settings') }}" class="nav-link {{  request()->routeIs('csv-export-settings') ? 'active' : '' }}"
                    >CSV Export Settings</a
                    >
                </li>
            </ul>
        </section>
        <!-- END SECOND NAVBAR -->

        <!-- START CSV EXPORT SETTINGS -->
        <section
            class="section-csv-export-settings u-padding-lg d-flex flex-column align-items-center"
        >
            <h3 class="fw-bold text-dark">CSV Export Settings</h3>
            <div class="card border-0 u-box-shadow-1">
                <div class="card-body p-4">
                    <h4 class="card-title border-0">
                        What is the CSV Export settings for?
                    </h4>
                    <p class="card-text text-secondary">
                        You can customize the default fields you want to download
                        every time you export a CSV file.
                    </p>
                    <div class="csv-export-box d-flex justify-content-between">
                        <div class="csv-export-icon-box d-flex align-items-center">
                            <i class="bi bi-people-fill px-3"></i>
                            <div class="csv-export-title">Contact CSV Export</div>
                        </div>

                        <!-- BUTTON TRIGGER MODAL -->
                        <button
                            type="button"
                            class="csv-export-button btn btn-access fw-bold"
                            data-bs-toggle="modal"
                            data-bs-target="#contactCSVExport"
                        >
                            <i class="bi bi-gear pe-1"></i>
                            Edit Settings
                        </button>

                        <!-- Modal -->
                        <div
                            class="modal fade"
                            id="contactCSVExport"
                            tabindex="-1"
                            aria-labelledby="contactCSVExportLabel"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4
                                                class="modal-title fw-bold text-dark"
                                                id="contactCSVExportLabel"
                                            >
                                                Contact CSV Export
                                            </h4>
                                            <div>
                                                <button
                                                    type="button"
                                                    class="btn btn-access text-dark"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Cancel
                                                </button>
                                                <button type="button" class="btn btn-purple">
                                                    Save settings
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div
                                                class="modal-body--header border-bottom py-3 d-flex align-items-center justify-content-between"
                                            >
                                                <h4 class="text-dark fw-bold">Standard Fields</h4>
                                                <a href="#" class="fs-4">Select All</a>
                                            </div>
                                            <div class="modal-body--content py-4">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>First Name</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="fname"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="fname"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>Last Name</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="lname"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="lname"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>Facebook Profile</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="facebook"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="facebook"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>Phone Number</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="number"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="number"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>Email</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="email"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="email"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>Gender</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="gender"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="gender"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>Relationship Status</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="realtionship"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="realtionship"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>Work Place</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="work"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="work"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>Last Education Year</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="education"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="education"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>Current Address</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="address"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="address"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>Home Town</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="hometown"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="hometown"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 p-2">
                                                            <div class="field-name-box">
                                                                <h5>Country</h5>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="checkbox"
                                                                        value=""
                                                                        id="country"
                                                                    />
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="country"
                                                                    >
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END CSV EXPORT SETTINGS -->
    </section>
@endsection
