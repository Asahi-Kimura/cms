@extends('layouts.contact')
@section('title','お問い合わせ')
@section('content')

<form method="POST" action="{{ route('contact_confirm') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="status" value="1">
    <div class="Form">
        @if($errors->any())
            <div class="alert-danger">エラーがあります</div>
        @endif
        
        <div class="Form-Item">
            <p class="Form-Item-Label">
                <span class="Form-Item-Label-Required">必須</span>お問い合わせ種別
            </p>
            <div>
                <div>
                    @foreach( $inquiry_type as $key => $value )
                        <input type="checkbox" class="form-check-input" name="inquiry_type[]" id="{{ $key }}" value="{{ $value }}"  {{ is_array(old("inquiry_type")) && in_array($value, old("inquiry_type"), true) ? 'checked' : ''}}>
                        <label for="{{$key}}" class="ck-box check-wrapper" >{{ $value }}</label>
                    @endforeach
                </div> 
                <div class="Form-Item-Error">
                    @if( $errors->has( 'inquiry_type' ) )
                        <li> お問い合わせ種別は必須項目です</li>
                    @endif 
                </div>
            </div>
        </div>
        <div class="Form-Item">
            <p class="Form-Item-Label">
                <span class="Form-Item-Label-Required">必須</span>会社名
            </p>
            <div>
                <div>
                    <input name="company_name" value ="{{ old('company_name') }}" type="text" class="Form-Item-Input" placeholder="例）株式会社〇〇">
                </div>
                <div class="Form-Item-Error">
                    @if( $errors->has('company_name') )
                        <li>{{ $errors->first('company_name') }}</li>
                    @endif
                </div>
            </div>
        </div>
        <div class="Form-Item">
            <p class="Form-Item-Label">
                <span class="Form-Item-Label-Required">必須</span>氏名
            </p>
            <div>
                <div>
                    <input name="user_name" value ="{{ old('user_name') }}" type="text" class="Form-Item-Input" placeholder="例）山田太郎">
                </div>
                <div class="Form-Item-Error">
                    @if($errors->has('user_name'))
                        <li>{{ $errors->first('user_name') }}</li>
                    @endif
                </div>
            </div>
        </div>

        {{--  画像 --}}
        <div class="Form-Item">
            <p class="Form-Item-Label">
                <span class="Form-Item-Label-Required">必須</span>証明写真
            </p>
            <div>
                <div>
                    @if(isset($temp_image))
                        <img src="{{ $temp_image }}" id="confirm_image" alt="証明写真">
                    @endif
                    <input type="file" name="file_image" value="" id="file_image" class="form-control" accept="image/*">
                </div>
                <img id="sample">
                <div class="Form-Item-Error">
                    @if($errors->has('file_image'))
                        <li>{{ $errors->first('file_image') }}</li>
                    @endif
                </div>
            </div>
        </div>
        <div class="Form-Item">
            <p class="Form-Item-Label">
                <span class="Form-Item-Label-Required">必須</span>電話番号
            </p>
            <div>
                <div>
                    <input name="tele_num" value ="{{ old('tele_num') }}" type="tel" class="Form-Item-Input" placeholder="例）000-0000-0000">
                </div>
                <div class="Form-Item-Error">
                    @if($errors->has('tele_num'))
                        <li>{{ $errors->first('tele_num') }}</li>
                    @endif
                </div>
            </div>
        </div>
        <div class="Form-Item">
            <p class="Form-Item-Label">
                <span class="Form-Item-Label-Required">必須</span>メールアドレス
            </p>
            <div>
                <div>
                    <input name="email" value ="{{ old('email') }}" type="email" class="Form-Item-Input" placeholder="例）example@gmail.com">
                </div>
                <div class="Form-Item-Error">
                    @if($errors->has('email'))
                        <li>{{ $errors->first('email') }}</li>
                    @endif
                </div>
            </div>
        </div>
        <div class="Form-Item">
            <p class="Form-Item-Label">
                <span class="Form-Item-Label-Required">必須</span>生年月日
            </p>
            <div>
                <div>
                    <input class="Select" type="text" name="birthday" value ="{{ old('birthday') }}" id ='birthday'>
                </div>
                <div class="Form-Item-Error">
                    @if($errors->has('birthday'))
                        <li>{{ $errors->first('birthday') }}</li>
                    @endif
                </div>
            </div>
        </div>
        <div class="Form-Item">
            <p class="Form-Item-Label">
                <span class="Form-Item-Label-Required">必須</span>性別
            </p>
            <div>
                <div class = "radio">   
                    @foreach($sex as $key => $value)
                        <label>
                            <input type="radio" name="sex" value="{{ $key }}" {{ old('sex') == $key ? 'checked' : '' }}>{{ $value }}
                        </label>
                    @endforeach
                </div>
                <div class="Form-Item-Error">
                    @if($errors->has('sex'))
                        <li>{{ $errors->first('sex') }}</li>
                    @endif
                </div>
            </div>
        </div>
        <div class="Form-Item">
            <p class="Form-Item-Label">
                <span class="Form-Item-Label-Required">必須</span>職業
            </p>
            <div>
                <div>
                    <select name="job" class="Select">
                        <option value="">職業を選択してください</option>
                        @foreach($job as $key => $value)
                            <option value="{{ $key }}" {{ old('job') == $key ? 'selected' : ''}} > {{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="Form-Item-Error">
                    @if($errors->has('job'))
                        <li>{{ $errors->first('job') }}</li>
                    @endif
                </div>
            </div>
        </div>
        <div class="Form-Item">
            <p class="Form-Item-Label isMsg">
                <span class="Form-Item-Label-Required">必須</span>お問い合わせ内容
            </p>
            <div>
                <div>
                    <textarea name="content" class="Form-Item-Textarea" rows="20">{{ old('content') }}</textarea>
                </div>
                <div class="Form-Item-Error">
                    @if($errors->has('content'))
                        <li>{{ $errors->first('content') }}</li>
                    @endif
                </div>
            </div>
        </div>
        <input type="submit" class="Form-Btn" value="確認する">
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<script>
    $(function(){
        $('#birthday').datepicker(
        );
    });
</script>

<script>
    $("#file_image").on('change', function (e) {
        var reader = new FileReader();
        reader.onload = function(e){
            $("#sample").attr("src",e.target.result).css('width', '100px').css('height', '100px');
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
<script>
    var $image = document.getElementById('confirm_image'); 
    $image.witdh = 100;
    $image.height = 100;
</script>
@endsection
