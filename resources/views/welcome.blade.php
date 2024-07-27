<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>
<div id="mainDiv">
</div>
<div id="phoneDiv" style="display: none">
    <div id="phone"></div>
    <div id="numbers" class="flex-wrap">
        <div class="div-box flex-wrap">
            <div class="number-box" onclick="writeNumber(1)">1</div>
            <div class="number-box" onclick="writeNumber(2)">2</div>
            <div class="number-box" onclick="writeNumber(3)">3</div>

            <div class="number-box" onclick="writeNumber(4)">4</div>
            <div class="number-box" onclick="writeNumber(5)">5</div>
            <div class="number-box" onclick="writeNumber(6)">6</div>

            <div class="number-box" onclick="writeNumber(7)">7</div>
            <div class="number-box" onclick="writeNumber(8)">8</div>
            <div class="number-box" onclick="writeNumber(9)">9</div>

            <div class="number-box" style="color: red" onclick="clearNumber()">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
            </div>
            <div class="number-box" onclick="writeNumber(0)">0</div>
            <div class="number-box" onclick="backNumber()" style="color: yellow">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                    <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                    <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
                </svg>
            </div>
        </div>
        <div class="div-box">
            <div class="confirm-btn" onclick="accept()" id="conf-btn"></div>
            <div class="cancel-btn" onclick="main()" id="can-btn"></div>
        </div>
    </div>
</div>
</body>
<script>
    let language_id=0;
    let mainDiv=document.getElementById('mainDiv');
    let phoneDiv=document.getElementById('phoneDiv');

    function start(){
        let addHtml = `
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
`;
        language_id=0;
        mainDiv.innerHTML=addHtml;
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
        mainDiv.style="";
        phoneDiv.style="display: none";
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
                mainDiv.innerHTML=`
                    <div class="cancel-box">
                        <div>
                            <svg onclick="start()" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-wrap">
                        <div class="div-box mt-3">
                            <div class="btn" onclick="JustAccept()">${data['btn1']}</div>
                            <div class="data">
                                <p>${data['t1']}</p>
                            </div>
                        </div>
                        <div class="div-box mt-3">
                            <div class="btn" onclick="phoneBody()">${data['btn2']}</div>
                            <div class="data">
                                <p>${data['t2']}</p>
                            </div>
                        </div>
                    </div>
                `;
            })
            .catch((error) => {
                console.log(error);
            })
    }

    function phoneBody(){
        fetch('{{route('phone')}}', {
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
                phoneDiv.style="";
                mainDiv.style="display: none";
                document.getElementById('conf-btn').innerHTML=data['btn1'];
                document.getElementById('can-btn').innerHTML=data['btn2'];
                clearNumber();
            })
            .catch((error) => {
                console.log(error);
            })
    }

    function accept(){
        if(phone.length!==9) {
            fetch('{{route('phone_incorrectly')}}', {
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
                    Swal.fire(`${data['text']}`, "", "info");
                })
                .catch((error) => {
                    console.log(error);
                })
            return 0;
        }
        fetch('{{route('accept')}}', {
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
                            <svg onclick="document.location='{{route('welcome')}}'" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                            </svg>
                        </div>
                    </div>
                    <div style="justify-content: center; font-size: 50px">
                        <h1 style="margin: 0" align="center" id="product_number">0</h1>
                    </div>
                    <div>
                        <div id="accept-box"></div>
                        <div class="btn-box flex-wrap">
                            <div class="btn-m div-box">

                            </div>
                            <div class="btn-m div-box">
                                <div class="confirm-btn" style="color: blueviolet" onclick="submit('${data['title']}','${data['text']}','${data['title_null']}','${data['text_null']}')">${data['btn1']}</div>
                            </div>
                        </div>
                    </div>
                `;

                phoneDiv.style="display: none";
                mainDiv.style="";

                init();

                mainDiv.innerHTML=addHtml;
            })
            .catch((error) => {
                console.log(error);
            })
    }
    function JustAccept(){
        fetch('{{route('JustAccept')}}', {
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
                            <svg onclick="document.location='{{route('welcome')}}'" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                            </svg>
                        </div>
                    </div>
                    <div style="justify-content: center; font-size: 50px">
                        <h1 style="margin: 0" align="center" id="product_number">0</h1>
                    </div>
                    <div>
                        <div id="accept-box"></div>
                        <div class="btn-box flex-wrap">
                            <div class="btn-m div-box">

                            </div>
                            <div class="btn-m div-box">
                                <div class="confirm-btn" style="color: blueviolet" onclick="submitEco('${data['title']}','${data['text']}','${data['title_null']}','${data['text_null']}')">${data['btn1']}</div>
                            </div>
                        </div>
                    </div>
                `;

                phoneDiv.style="display: none";
                mainDiv.style="";

                init();

                mainDiv.innerHTML=addHtml;
            })
            .catch((error) => {
                console.log(error);
            })
    }
</script>
<script>
    start();
    function submit(title,text,title_null,text_null) {
        if(document.getElementById('product_number').innerHTML===0){
            Swal.fire({
                position: "center",
                icon: "error",
                title: title_null,
                text: text_null,
                showConfirmButton: true,
                showCancelButton: true,
                timer: 10000
            }).then((result) => {
                if(result.isConfirmed) {
                    document.location = "{{route("welcome")}}";
                }
            });
        } else {
            fetch('{{route('save_data')}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    phone: phone,
                    product_number: document.getElementById('product_number').innerHTML,
                })
            })
                .then(response => response.json())
                .then(data => {
                    // if (data['status']==="accept") {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: title,
                            text: text,
                            showConfirmButton: true,
                            timer: 10000
                        }).then((result) => {
                            document.location = "{{route("welcome")}}";
                        });
                    // }
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    }
    function submitEco(title,text,title_null,text_null) {
        if(document.getElementById('product_number').innerHTML===0){
            Swal.fire({
                position: "center",
                icon: "error",
                title: title_null,
                text: text_null,
                showConfirmButton: true,
                showCancelButton: true,
                timer: 10000
            }).then((result) => {
                if(result.isConfirmed) {
                    document.location = "{{route("welcome")}}";
                }
            });
        } else {
            fetch('{{route('save_data')}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    phone: 0,
                    product_number: document.getElementById('product_number').innerHTML,
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // if (data['status']==="accept") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: title,
                        text: text,
                        showConfirmButton: true,
                        timer: 10000
                    }).then((result) => {
                        document.location = "{{route("welcome")}}";
                    });
                    // }
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    }
</script>
<script src="{{asset('js/script.js')}}"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>





<script src="{{asset('tf.js')}}"></script>
<script src="{{asset('teachablemachine-image.js')}}"></script>
<script type="text/javascript">
    // More API functions here:
    // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

    // the link to your model provided by Teachable Machine export panel
    const URL = "{{asset('my_model')}}/";

    let model, webcam, labelContainer, maxPredictions;

    let cameraBool=true;
    async function init() {
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";

        // load the model and metadata
        // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
        // or files from your local hard drive
        // Note: the pose library adds "tmImage" object to your window (window.tmImage)
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();

        const flip = true; // whether to flip the webcam
        webcam = new tmImage.Webcam(200, 200, flip); // width, height, flip
        await webcam.setup(); // request access to the webcam
        await webcam.play();
        window.requestAnimationFrame(loop);

        // append elements to the DOM
        // document.getElementById("webcam-container").appendChild(webcam.canvas);
        //labelContainer = document.getElementById("label-container");
        // for (let i = 0; i < maxPredictions; i++) { // and class labels
        //     labelContainer.appendChild(document.createElement("div"));
        // }
    }

    async function loop() {
        webcam.update(); // update the webcam frame
        await predict();
        window.requestAnimationFrame(loop);
    }

    // run the webcam image through the image model
    async function predict() {
        // predict can take in an image, video or canvas html element
        const prediction = await model.predict(webcam.canvas);
        for (let i = 1; i < maxPredictions; i++) {
            const classPrediction =
                prediction[i].className + ": " + prediction[i].probability.toFixed(2);
            console.log(prediction[i].probability.toFixed(2));
            if(prediction[i].probability.toFixed(2)>0.99 && cameraBool){
                cameraBool=false;
                runMotor();
            }
        }
    }
    function runMotor(){
        let ipAddress = '192.168.93.95';
        let pin1 = '2';
        let pin2 = '4';
        let second = '3';
        let analogPin = '5';
        let speed = '100';

        let xhr = new XMLHttpRequest();
        let url = 'http://' + ipAddress + '/sendSignal?pin1=' + pin1 + '&pin2=' + pin2 + '&second=' + second + '&speed=' + speed + '&analogPin=' + analogPin;

        xhr.open('GET', url, true);
        xhr.send();

        xhr.onload = function() {
            if (xhr.status === 200) {
                cameraBool=true;
                console.log("Accept");
                document.getElementById('product_number').innerHTML=parseInt(document.getElementById('product_number').innerHTML)+1;
                // alert('Signal muvaffaqiyatli yuborildi!');
            } else {
                // alert('Signal yuborishda xatolik yuz berdi.');
            }
        };
    }
</script>


</html>
