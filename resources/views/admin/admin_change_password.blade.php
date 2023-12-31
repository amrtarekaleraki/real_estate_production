@extends('admin.admin_dashboard')

@section('admin')


<div class="page-content">

     <div class="container">

        <div class="all-files">

            <div class="row p-3">

                <div class="col-lg-12">
                    <div class="all-files-title">
                        <h2>تغيير كلمه المرور</h2>
                    </div>
                </div>

                <form method="POST" action="{{ route('update.password') }}">
                    @csrf

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                            {{session('status')}}
                    </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                    @endif

                    <div class="row p-3">

                        <div class="col-lg-4 add-buildings-inputs">
                            <label for="">الرقم السري القديم</label>
                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="current_password" placeholder=" الرقم السري"  >
                            @error('old_password')
                              <span class="text-danger">كلمه المرور القديمه غير صحيحه</span>
                            @enderror
                        </div>

                         <div class="col-lg-4 add-buildings-inputs">
                             <label for="">الرقم السري الجديد</label>
                             <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="الرقم السري">
                             @error('new_password')
                                <span class="text-danger">تأكيد كلمة المرور الجديدة غير متطابق</span>
                             @enderror
                            </div>

                          <div class="col-lg-4 add-buildings-inputs">
                             <label for="">اعاده كتابه الرقم السري الجديد</label>
                             <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" placeholder="الرقم السري">
                          </div>

                    </div>


                    <div class="add-permision-item-button">
                        <input type="submit" value="حفظ">
                    </div>

                </form>

            </div>
        </div>

     </div>

  </div>




@endsection
