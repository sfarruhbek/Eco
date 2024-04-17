<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body id="mainDiv">

@yield('content')

</body>
<script>
    let language_id=0;
    let mainDiv=document.getElementById('mainDiv');

    function start(){
        addHtml=`
            <div class="flex-wrap">
                <div id="div-1">
                    <img src="{{asset('images/eco.png')}}">
                </div>
                <div id="div-2">
                    @foreach($languages as $val)
                <div class="language-box" onclick="language({{$val->id}})">{{$val->name}}</div>
                    @endforeach
                </div>
            </div>
        `
    }
    function language(lan){
        fetch('{{route('language')}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                lan: lan,
            })
        })
            .then(response => response.json())
            .then(data => {
                language_id=data['id'];
                main();
            })
            .catch((error) => {
                console.log(error);
            })
    }
    function main(){
        console.log(language_id);
        fetch('{{route('main')}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                lan: language_id,
            })
        })
            .then(response => response.json())
            .then(data => {
                let addHtml=`
                    <div class="cancel-box">
                        <div>
                            <svg onclick="start()" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-wrap">
                        <div class="div-box mt-3">
                            <div class="btn" onclick="document.location='accept.html'">${data['btn1']}</div>
                            <div class="data">
                                <p>${data['t1']}</p>
                            </div>
                        </div>
                        <div class="div-box mt-3">
                            <div class="btn" onclick="document.location='phone.html'">${data['btn2']}</div>
                            <div class="data">
                                <p>${data['t2']}</p>
                            </div>
                        </div>
                    </div>
                `
                mainDiv.innerHTML=addHtml;
            })
            .catch((error) => {
                console.log(error);
            })
    }
</script>
</html>
