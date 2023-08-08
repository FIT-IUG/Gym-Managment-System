@extends('gest.parent')
@section('title', 'User Profile')
@section('styles')
    <link href="{{ asset('coustom/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('coustom/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('coustom/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/Membership.css') }}" />
@endsection
@section('nav_bg', 'bg-secondary')
@section('closeMain')

@stop
@role('client')
    @section('main-content')
        <!-- Personal Information -->
        <section class="PersonalInformation bg-primary">
            <div class="container pt-5">

                <nav class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1" aria-label="breadcrumb">
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item fw-bold fs-3">
                            <a href="{{ route('home') }}" class="text-white text-decoration-none">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px" style="margin-left: 5px"> </span>
                        </li>
                        <li class="breadcrumb-item text-muted"> معلومات شخصية</li>
                    </ul>
                </nav>
                <div class="row row-cols-1  row-cols-md-1 row-cols-lg-2   pb-5 mb-5 mt-5 pt-3">
                    <div
                        class="col  col-lg-4 min-vh-50 bg-primary-op rounded-5 shadow d-flex justify-content-center py-5 mt-5 mt-lg-0  ">
                        <div class="  border-0 text-white d-flex flex-column justify-content-center align-items-center"
                            style="width: 18rem">
                            {{--                                                <a> --}}
                            {{--                                                    <span class="badge bg-danger position-absolute"> --}}
                            {{--                                                        <i class="fa fa-times" onclick="deleteImage()"></i> --}}
                            {{--                                                    </span> --}}
                            {{--                                                    <img id="profile_img" src="{{ asset('imgs/users/' . Auth::user()->profile_img) }}" --}}
                            {{--                                                         width="200px" --}}
                            {{--                                                         height="200px" class="card-img-top" style="margin-bottom: -25px;border-radius: 100%" --}}
                            {{--                                                         alt="..."> --}}
                            {{--                                                    <span class="badge bg-info position-relative" style="float: left" --}}
                            {{--                                                          data-action="edit"> --}}
                            {{--                                                        <i class="fa fa-edit" onclick="document.getElementById('fileInput').click()"></i> --}}
                            {{--                                                    </span> --}}
                            {{--                                                    <input type="file" id="fileInput" style="display: none" accept=".png, .jpg, .jpeg"> --}}
                            {{--                                                </a> --}}
                            <form enctype="multipart/form-data" action="{{ route('profile.update') }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                <div class="col-lg-8">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true"
                                        style="background-image: url('{{ asset('coustom/assets/media/svg/avatars/blank.svg') }}')">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url({{ asset('imgs/users/' . Auth::user()->profile_img) }});">
                                        </div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title=""
                                            data-bs-original-title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" id="profile_image" name="profile_image"
                                                accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="avatar_remove" value="0">
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        {{--                                    <span --}}
                                        {{--                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" --}}
                                        {{--                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" --}}
                                        {{--                                        data-bs-original-title="Cancel avatar"> --}}
                                        {{--                                                                    <i class="bi bi-x fs-2"></i> --}}
                                        {{--                                                                </span> --}}
                                        {{--                                    <!--end::Cancel--> --}}
                                        {{--                                    <!--begin::Remove--> --}}
                                        {{--                                    <span --}}
                                        {{--                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" --}}
                                        {{--                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" --}}
                                        {{--                                        data-bs-original-title="Remove avatar"> --}}
                                        {{--                                                                    <i class="bi bi-x fs-2"></i> --}}
                                        {{--                                                                </span> --}}
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    {{--                                                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div> --}}
                                    <!--end::Hint-->
                                </div>
                                {{--                            <div class="fv-row mb-10 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid"> --}}
                                {{--                                <!--begin::Label--> --}}
                                {{--                                <label class="d-block fw-semibold fs-6 mb-5"> --}}
                                {{--                                    <span class="required">Company Logo</span> --}}


                                {{--                                    <span class="ms-1" data-bs-toggle="tooltip" aria-label="E.g. Select a logo to represent the company that's running the campaign." data-bs-original-title="E.g. Select a logo to represent the company that's running the campaign." data-kt-initialized="1"> --}}
                                {{--	<i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>            </label> --}}
                                {{--                                <!--end::Label--> --}}

                                {{--                                <!--begin::Image input placeholder--> --}}
                                {{--                                <style> --}}
                                {{--                                    .image-input-placeholder { --}}
                                {{--                                        /*background-image: url('/metronic8/demo1/assets/media/svg/files/blank-image.svg');*/ --}}
                                {{--                                        background-image: url('{{asset('coustom/assets/media/svg/files/blank-image.svg')}}'); --}}
                                {{--                                    } --}}

                                {{--                                    [data-bs-theme="dark"] .image-input-placeholder { --}}
                                {{--                                        background-image: url('{{ asset('imgs/users/' . Auth::user()->profile_img) }}'); --}}
                                {{--                                    } --}}
                                {{--                                </style> --}}
                                {{--                                <!--end::Image input placeholder--> --}}

                                {{--                                <!--begin::Image input--> --}}
                                {{--                                <div class="image-input image-input-outline image-input-placeholder image-input-empty" data-kt-image-input="true"> --}}
                                {{--                                    <!--begin::Preview existing avatar--> --}}
                                {{--                                    <div class="image-input-wrapper w-125px h-125px" style=""></div> --}}
                                {{--                                    <!--end::Preview existing avatar--> --}}

                                {{--                                    <!--begin::Label--> --}}
                                {{--                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1"> --}}
                                {{--                                        <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i> --}}
                                {{--                                        <!--begin::Inputs--> --}}
                                {{--                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg"> --}}
                                {{--                                        <input type="hidden" name="avatar_remove" value="0"> --}}
                                {{--                                        <!--end::Inputs--> --}}
                                {{--                                    </label> --}}
                                {{--                                    <!--end::Label--> --}}

                                {{--                                    <!--begin::Cancel--> --}}
                                {{--                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1"> --}}
                                {{--                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>                </span> --}}
                                {{--                                    <!--end::Cancel--> --}}

                                {{--                                    <!--begin::Remove--> --}}
                                {{--                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1"> --}}
                                {{--                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>                </span> --}}
                                {{--                                    <!--end::Remove--> --}}
                                {{--                                </div> --}}
                                {{--                                <!--end::Image input--> --}}

                                {{--                                <!--begin::Hint--> --}}
                                {{--                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div> --}}
                                {{--                                <!--end::Hint--> --}}
                                {{--                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div> --}}
                                {{--                        </form> --}}
                                <div class="card-body ">
                                    {{--                            <h4 class="card-title mt-5 text-warning">غير صورتك</h4> --}}
                                    <p class="card-text text-muted mt-5 fs-25 ms-2 ">اسم: <span
                                            class="ms-3 text-white fw-light">{{ auth()->user()->name }}</span></p>
                                    <p class="card-text text-muted mt-4 fs-25 ms-2 ">عمر: <span
                                            class="ms-4 ps-2 text-white fw-light">{{ $age }}</span></p>
                                    <p class="card-text text-muted mt-4 fs-25  ms-2">البريد الإلكتروني: <span
                                            class="ms-3 text-white fw-light">{{ auth()->user()->email }}</span></p>
                                </div>
                        </div>
                    </div>
                    <div class="col col-lg-8 px-5 pt-8 pt-lg-0  ">
                        <form class="row px-0 px-lg-5 px-sm-0 px-md-0 fw-light">
                            @csrf
                            <h2 class="text-white">تغيير المعلومات الخاصة بي</h2>
                            <div class="col-12 mt-4  ">
                                <label for="" class="form-label fs-25 text-light opacity-75">الاسم</label>
                                <input type="text" class="form-control bg-primary-op fs-25 py-3 ps-4 border-0 text-muted"
                                    name="name" placeholder="{{ $user->name }}" value="{{ $user->name }}"
                                    aria-label="F_Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mt-4">
                                <label for="" class="form-label fs-25 text-light opacity-75">البريد الإلكتروني</label>
                                <input type="email" class="form-control bg-primary-op text-muted fs-25 py-3 ps-4 border-0"
                                    id="email" name="email" placeholder="{{ $user->email }}"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mt-4">
                                <label for="" class="form-label fs-25 text-light opacity-75">الصورة الشخصية</label>
                                <input type="file" class="form-control bg-primary-op text-muted fs-25 py-3 ps-4 border-0"
                                    name="profile_img" id="profile_img" aria-describedby="fileHelpId">
                                {{--                                <small id="fileHelpId" class="form-text text-muted">png or jpg</small> --}}
                            </div>
                            <div class="col-12 mt-4">
                                <label for="" class="form-label fs-25 text-light opacity-75">يوم ميلادي</label>
                                <input type="date" name="date_of_birth"
                                    class="form-control bg-primary-op text-muted fs-25 py-3 ps-4 border-0"
                                    value="{{ \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') }}" id=""
                                    placeholder="{{ \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') }}">
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mt-4  d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary fw-bold  fs-25 py-2 px-5 rounded-3">تعديل
                                </button>
                            </div>
                            <!-- <div class="col-12 mt-4">
                                  <label for="" class="form-label fs-25 text-light opacity-75">password</label>
                                  <input type="password" class="form-control bggg fs-25 py-3 ps-4 border-0" id="" placeholder=".................">
                                </div> -->
                        </form>
                        </form>
                        <form class="row px-0 px-lg-5 px-sm-0 px-md-0 fw-light"
                            action="{{ route('profile.updatePassword') }}" method="post">
                            @csrf
                            @method('put')
                            <h2 class="text-white">إعادة تعيين كلمة المرور</h2>
                            <div class="col-12 mt-4">
                                <label for="" class="form-label fs-25 text-light opacity-75">كلمة المرور
                                    القديمة</label>
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror bg-primary-op text-muted fs-25 py-3 ps-4 border-0"
                                    name="oldpassword" placeholder="********************">
                                @error('oldpassword')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @if ($msg != 0)
                                    <div class="alert alert-danger">{{ $msg }}</div>
                                @endif
                            </div>
                            <div class="col-12 mt-4">
                                <label for="" class="form-label fs-25 text-light opacity-75">كلمة المرور
                                    الجديدة</label>
                                <input type="password" class="form-control bg-primary-op text-muted fs-25 py-3 ps-4 border-0"
                                    name="newpassword" placeholder="********************">
                                @error('newpassword')
                                    <div class="alert alert-danger p-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-4  d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary fw-bold  fs-25 py-2 px-5 rounded-3">حفظ
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </section>
    @endsection
@endrole

@section('scripts')
    <script src="{{ asset('js/axios.js') }}"></script>
    <script>
        // Function to preview the selected image
        function previewImage(event) {
            const file = event.target.files[0];
            console.log(file);
            if (file) {
                const profileImage = document.querySelector('.image-input-wrapper');
                const reader = new FileReader();
                reader.onload = (e) => {
                    profileImage.style.backgroundImage = `url(${e.target.result})`;
                };
                console.log(reader);
                reader.readAsDataURL(file);
            }
        }

        // Function to cancel the image selection
        function cancelImage() {
            const profileImage = document.querySelector('.image-input-wrapper');
            profileImage.style.backgroundImage = `url('{{ asset('imgs/users/' . Auth::user()->profile_img) }}')`;
            const fileInput = document.getElementById('fileInput');
            fileInput.value = '';
        }

        // Function to remove the selected image
        function removeImage() {
            const profileImage = document.querySelector('.image-input-wrapper');
            profileImage.style.backgroundImage = `url('{{ asset('assets/media/svg/avatars/blank.svg') }}')`;
            const fileInput = document.getElementById('fileInput');
            fileInput.value = '';
        }
    </script>

    <script>
        var hostUrl = "coustom/assets/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ 'coustom/asset' }}"></script>
    <script src="{{ asset('coustom/assets/plugins/global/plugins.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('coustom/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('coustom/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/account/settings/signin-methods.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/account/settings/profile-details.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/account/settings/deactivate-account.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/utilities/modals/offer-a-deal/type.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/utilities/modals/offer-a-deal/details.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/utilities/modals/offer-a-deal/finance.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/utilities/modals/offer-a-deal/complete.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/utilities/modals/offer-a-deal/main.js') }}"></script>
    <script src="{{ asset('coustom/assets/js/custom/utilities/modals/two-factor-authentication.js') }}"></script>

@endsection
