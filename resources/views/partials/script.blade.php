

    <script src="{{ asset('backend/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="{{ asset('backend/assets/js/line-chart.js') }}"></script>
    <!-- all pie chart -->
    <script src="{{ asset('backend/assets/js/pie-chart.js') }}"></script>

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <!-- others plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('backend/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>


@if(Request()->path() == "stockadd")

    <script type="text/javascript">

        $("#stockoutstoresubmit").submit(function(e){
 
            var form = $("#stockoutstoresubmit").get(0);
            $.ajax({
                url : "{{route('stockinsert.extrastockinsert')}}",
                method: "post",
                data : new FormData(form),
                contentType : false,
                processData : false,
                beforeSend : function(){
                    $(document).find(".form-text").text("");
                },
                success: function(data){
                    
                    if (data.message == "error") {
                        $.each(data.data, function(prefix, values){
                            $("#err"+prefix.replace(".","_")).text(values).css({
                                "color" : "red",
                                "font-weight" : "bold",
                            });
                        });
                    }
                    if(data.status == "reload"){
                        window.location.href = "{{Route('stockin.list')}}";
                    }
                }
            });
            return false;
        });

  

        var error = 0;

        $("#stockoutadd").click(function(){

            var stockSelectedData = $(".autocompleteValue").val();

            if(stockSelectedData != ""){

                $("#sthead").css({
                    "display" : "contents"
                });
                $("#stockoutsubmit").css({
                    "display" : "block"
                });

                if($(".trid_"+stockSelectedData).length == 0){

                $.ajax({
                    url : "{{route('stockout-idbydata.stockoutbydata')}}",
                    method: "get",
                    data : {
                        "id" : stockSelectedData
                    },
                    beforeSend : function(){
                        $(document).find(".form-text").text("");
                    },
                    success: function(res){

                        $("#stbody").append(`

                            <tr class="tr colLenth trid_${res.data.id}">
                            <td>${res.data.name}</td>
                            <td>${res.brand}</td>
                            <td>${res.color}</td>
                            <td>${res.size}</td>
                            <td><span class="current_stock">${res.currentStock}</span></td>
                            <td>
                                <input type="number" name="Qty[]" value="" class="form-control" placeholder="Qty" min="1" required>
                                <input type="hidden" name="stockinid[]" value="${res.data.id}"/>
                                <small class="form-text ${res.currentStock}_${res.data.id}" id="errQty_${error++}" style="color:tomato"></small>
                            </td>
                            <td>
                                <button type="button" id="stockoutremove" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>`);

                    }
                });

                }else{
                    alert("This is product already added!");
                }
            }
        });

        $("#stbody").on("click","#stockoutremove",function(){

            if($(".colLenth").length <= 1){

                $("#sthead").css({
                    "display" : "none"
                });

                $("#stockoutsubmit").css({
                    "display" : "none"
                });

            }

            $(this).parent().parent().remove();
        });
    </script>




@elseif(Request()->path() == "refund-add")

    {{-- For Refund --}}

        <script type="text/javascript">

        $("#refundSubmit").submit(function(e){
 
            var form = $("#refundSubmit").get(0);
            $.ajax({
                url : "{{route('refund.store')}}",
                method: "post",
                data : new FormData(form),
                contentType : false,
                processData : false,
                beforeSend : function(){
                    $(document).find(".form-text").text("");
                },
                success: function(data){

                    if (data.message == "error") {
                        $.each(data.data, function(prefix, values){
                            $("#err"+prefix.replace(".","_")).text(values).css({
                                "color" : "red",
                                "font-weight" : "bold",
                            });
                        });
                    }
                    if(data.status == "reload"){
                        window.location.href = "{{Route('refund.list')}}";
                    }
                }
            });
            return false;
        });

  

        var error = 0;

        $("#stockoutadd").click(function(){

            var stockSelectedData = $(".autocompleteValue").val();

            if(stockSelectedData != ""){

                $("#sthead").css({
                    "display" : "contents"
                });
                $("#stockoutsubmit").css({
                    "display" : "block"
                });

                if($(".trid_"+stockSelectedData).length == 0){

                $.ajax({
                    url : "{{route('stockout-idbydata.stockoutbydata')}}",
                    method: "get",
                    data : {
                        "id" : stockSelectedData
                    },
                    beforeSend : function(){
                        $(document).find(".form-text").text("");
                    },
                    success: function(res){

                        $("#stbody").append(`

                            <tr class="tr colLenth trid_${res.data.id}">
                            <td>${res.data.name}</td>
                            <td>${res.brand}</td>
                            <td>${res.color}</td>
                            <td>${res.size}</td>
                            <td><span class="current_stock">${res.currentStock}</span></td>
                            <td>
                                <input type="number" name="Qty[]" value="" class="form-control" placeholder="Qty" min="1" required>
                                <input type="hidden" name="stockinid[]" value="${res.data.id}"/>
                                <small class="form-text ${res.currentStock}_${res.data.id}" id="errQty_${error++}" style="color:tomato"></small>
                            </td>
                            <td>
                                <button type="button" id="stockoutremove" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>`);

                    }
                });

                }else{
                    alert("This is product already added!");
                }
            }
        });

        $("#stbody").on("click","#stockoutremove",function(){

            if($(".colLenth").length <= 1){

                $("#sthead").css({
                    "display" : "none"
                });

                $("#stockoutsubmit").css({
                    "display" : "none"
                });

            }

            $(this).parent().parent().remove();
        });
    </script>



@else

    <script type="text/javascript">
        function check_qty_value(values, qty, currentStock){
            if(values == 0){
                $("."+qty+"_"+currentStock).text("Please valid qty."); 
            }else if(qty < values){
                $("."+qty+"_"+currentStock).text("Check your current qty."); 
           }else{
                $("."+qty+"_"+currentStock).text("");
           }
        }

        $("#stockoutstoresubmit").submit(function(e){
 
            var form = $("#stockoutstoresubmit").get(0);
            $.ajax({
                url : "{{route('stockout.stockoutstore')}}",
                method: "post",
                data : new FormData(form),
                contentType : false,
                processData : false,
                beforeSend : function(){
                    $(document).find(".form-text").text("");
                },
                success: function(data){
                    if (data.message == "error") {
                        $.each(data.data, function(prefix, values){
                            $("#err"+prefix.replace(".","_")).text(values).css({
                                "color" : "red",
                                "font-weight" : "bold",
                            });
                        });
                    }
                    if(data.status == "reload"){
                        window.location.href = "{{Route('stockout.list')}}";
                    }
                }
            });
            return false;
        });

  

        var error = 0;

        $("#stockoutadd").click(function(){

            // var stockSelectedData = $("#stockSelectedData").val();
            var stockSelectedData = $(".autocompleteValue").val();

            if(stockSelectedData != ""){

                $("#sthead").css({
                    "display" : "contents"
                });
                $("#stockoutsubmit").css({
                    "display" : "block"
                });

                if($(".trid_"+stockSelectedData).length == 0){

                $.ajax({
                    url : "{{route('stockout-idbydata.stockoutbydata')}}",
                    method: "get",
                    data : {
                        "id" : stockSelectedData
                    },
                    beforeSend : function(){
                        $(document).find(".form-text").text("");
                    },
                    success: function(res){

                        $("#stbody").append(`

                            <tr class="tr colLenth trid_${res.data.id}">
                            <td>${res.data.name}</td>
                            <td>${res.brand}</td>
                            <td>${res.color}</td>
                            <td>${res.size}</td>
                            <td><span class="current_stock">${res.currentStock}</span></td>
                            <td>
                                <input type="number" name="Qty[]" value="" class="form-control" onkeyup="check_qty_value(this.value, ${res.currentStock}, ${res.data.id})" placeholder="Qty" min="1" max="${res.currentStock}" required>
                                <input type="hidden" name="stockinid[]" value="${res.data.id}"/>
                                <small class="form-text ${res.currentStock}_${res.data.id}" id="errQty_${error++}" style="color:tomato"></small>
                            </td>
                            <td>
                                <button type="button" id="stockoutremove" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>`);

                    }
                });

                }else{
                    alert("This is product already added!");
                }
            }
        });

        $("#stbody").on("click","#stockoutremove",function(){

            if($(".colLenth").length <= 1){

                $("#sthead").css({
                    "display" : "none"
                });

                $("#stockoutsubmit").css({
                    "display" : "none"
                });

            }

            $(this).parent().parent().remove();
        });



    </script>


@endif





    {{-- stockForm Store Data --}}
    @if(Request()->path() == "stock-add")

    <script type="text/javascript">
        // stockForm form submit
        $("#stockForm").submit(function(){
            var form = $("#stockForm").get(0);
            $.ajax({
                url : "{{route('stock.store')}}",
                method: "post",
                data : new FormData(form),
                contentType : false,
                processData : false,
                beforeSend : function(){
                    $(document).find(".form-text").text("");
                },
                success: function(data){

                    if (data.message == "error") {
                        $.each(data.data, function(prefix, values){
                            $("#err"+prefix.replace(".","_")).text(values).css({
                                "color" : "red",
                                "font-weight" : "bold",
                            });
                        })
                   }


                    if(data.status == "reload"){
                        window.location.href = "{{Route('stock.list')}}"
                    }
                }
            });
            return false;
        });
    </script>

    {{-- Add More Options --}} 
    <script type="text/javascript">
            var i = 2;
            var sel_num = 0;
        $("#addMore").click(function(){
            sel_num++;
            $("#addMoreColumn").append(`<div><hr style="border: 1px solid #ddd;">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="my-2">Product Section: ${i++}<h5>
                    <button type="button" class="btn btn-danger colRemove">Delete</button>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input type="text" name="name[]" class="form-control" placeholder="Enter Product Name">
                            <small id="errname_${sel_num}" class="form-text"></small>
                        </div> 
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">

                        <div class="form-group">
                            <label for="">Category *</label>
                            <select class="select-form form-control" name="category_id[]">
                                <option value="" selected>Select Category</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <small id="errcategory_id_${sel_num}" class="form-text"></small>
                        </div>

                            </div>
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="">Brand*</label>
                                    <select class="select-form form-control" name="brand_id[]">
                                        <option value="" selected>Select Brand</option>
                                        @foreach ($brands as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <small id="errbrand_id_${sel_num}" class="form-text"></small>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Color*</label>
                                    <select class="select-form form-control" name="color_id[]">
                                        <option value="" selected>Select Color</option>
                                        @foreach ($colors as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <small id="errcolor_id_${sel_num}" class="form-text"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Model</label>
                            <select class="select-form form-control" name="model_id[]">
                                <option selected value="">Select Model</option>
                                @foreach ($models as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Qty*</label>
                                        <input type="text" class="form-control" name="qty[]" placeholder="Qty">
                                    </div>
                                    <small id="errqty_${sel_num}" class="form-text"></small>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Size</label>
                                        <select class="select-form form-control" name="size_id[]">
                                            <option selected value="">Select Size</option>
                                            @foreach ($sizes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Capacity</label>
                            <select class="select-form form-control" name="capacity_id[]">
                                <option selected value="">Select Capacity</option>
                                @foreach ($capacities as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group imageChange d-flex gap-2">
                            <div class="mr-3">
                                <label for="rentsImage">Image</label>
                                <input type="file" name="image[]" class="form-control imageSelect">
                            </div>
                            <img class="imagePreview mt-3 border rounded" src="{{ asset('backend/assets/images/no-image.png') }}" alt="Image" style="width:80px;height: 80px;object-fit:contain;">
                        </div>
                    </div>

                </div>
            </div>`);

            let images = $('body .imageSelect');
            // console.log(images.length);
            $('body .imageSelect').on('change',function(event){
                let isThis = this;
                let reader = new FileReader();
                reader.onload = function(){
                    let output = isThis.closest('.imageChange').querySelector('.imagePreview');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            });

        });

        $("#addMoreColumn").on("click",".colRemove", function(){
            $(this).parent().parent().parent().remove();
            i--;
        });
    </script>


    <script type="text/javascript">
        var i = 2;
        var sel_num = 0;
        $("#addMoreRow").click(function(){
            sel_num++;
            $("#addMoreRowDiv").append(`<div><hr><div class="row px-5">
                <div class="col-sm-11">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" name="qty[]" placeholder="Qty *">
                                <small id="errqty_0" class="form-text"></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="select-form form-control form-select-sm" name="size_id[]">
                                    <option selected value="">Select Size</option>
                                    @foreach ($sizes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <small id="errsize_id" class="form-text"></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="select-form form-control form-select-sm" name="capacity_id[]">
                                    <option selected value="">Select Capacity</option>
                                    @foreach ($capacities as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <small id="errcapacity_id[]" class="form-text"></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group imageChange d-flex gap-2">
                                <div class="">
                                    <input type="file" name="image[]" class="form-control form-control-sm imageSelect" style="width:0;height:0;padding:0">
                                </div>
                                <img class="imagePreview border rounded" src="{{ asset('backend/assets/images/no-image.png') }}" alt="Image" style="width:60px;height: 60px;object-fit:contain;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-sm btn-danger rowDivRemove">Remove</button>
                </div>
            </div><div>`);

            let images = $('body .imageSelect');
            // console.log(images.length);
            $('body .imageSelect').on('change',function(event){
                let isThis = this;
                let reader = new FileReader();
                reader.onload = function(){
                    let output = isThis.closest('.imageChange').querySelector('.imagePreview');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);    
            });

            $('body .imagePreview').on('click',function(){
                $(this).closest('.imageChange').find('.imageSelect').trigger('click')
            });
        });

        $("#addMoreRowDiv").on("click",".rowDivRemove", function(){
            $(this).parent().parent().parent().remove();
            i--;
        });

        $('body .imagePreview').on('click',function(){
            $(this).closest('.imageChange').find('.imageSelect').trigger('click')
        });
    </script>

    @endif




    {{-- Site Setting --}}
    <script>

        $('body .imageSelect').on('change',function(event){
            let isThis = this;
            let reader = new FileReader();
            reader.onload = function(){
                let output = isThis.closest('.imageChange').querySelector('.imagePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        })

        $('body .imageSelect').on('change',function(event){
            let isThis = this;
            let reader = new FileReader();
            reader.onload = function(){
                let output = isThis.closest('.imageChange').querySelector('.imagePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        })
        
        $('body .headerSettings').on('change',function(event){
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.querySelector('.headerSettingsPreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        })
        $('body .footerSettings').on('change',function(event){
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.querySelector('.footerSettingsPreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        })
        $('body .copyrightSettings').on('change',function(event){
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.querySelector('.copyrightSettingsPreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        })


        // Setting form submit
        $(".SettingFormSubmit1").submit(function(){
            var form = $(".SettingFormSubmit1").get(0);
            $.ajax({
                url : "{{route('settings.update.header')}}",
                method: "post",
                data : new FormData(form),
                contentType : false,
                processData : false,
                beforeSend : function(){
                    $(document).find(".form-text").text("");
                },
                success: function(data){
                    if(data.message == "error"){
                        $.each(data.data, function(key, value){
                            $("#err"+key).text(value).css("color","red");
                        });
                    }
                    if(data.status == "reload"){
                        window.location.href = "{{Route('settings.page')}}";
                    }
                }
            });
            return false;
        });
        $(".SettingFormSubmit2").submit(function(){
            var form = $(".SettingFormSubmit2").get(0);
            $.ajax({
                url : "{{route('settings.update.information')}}",
                method: "post",
                data : new FormData(form),
                contentType : false,
                processData : false,
                beforeSend : function(){
                    $(document).find(".form-text").text("");
                },
                success: function(data){
                    if(data.message == "error"){
                        $.each(data.data, function(key, value){
                            $("#err"+key).text(value).css("color","red");
                        });
                    }
                    if(data.status == "reload"){
                        window.location.href = "{{Route('settings.page')}}";
                    }
                }
            });
            return false;
        });
        $(".SettingFormSubmit3").submit(function(){
            var form = $(".SettingFormSubmit3").get(0);
            $.ajax({
                url : "{{route('settings.update.social')}}",
                method: "post",
                data : new FormData(form),
                contentType : false,
                processData : false,
                beforeSend : function(){
                    $(document).find(".form-text").text("");
                },
                success: function(data){
                    if(data.message == "error"){
                        $.each(data.data, function(key, value){
                            $("#err"+key).text(value).css("color","red");
                        });
                    }
                    if(data.status == "reload"){
                        window.location.href = "{{Route('settings.page')}}";
                    }
                }
            });
            return false;
        });
        $(".SettingFormSubmit4").submit(function(){
            var form = $(".SettingFormSubmit4").get(0);
            $.ajax({
                url : "{{route('settings.update.footer')}}",
                method: "post",
                data : new FormData(form),
                contentType : false,
                processData : false,
                beforeSend : function(){
                    $(document).find(".form-text").text("");
                },
                success: function(data){
                    if(data.message == "error"){
                        $.each(data.data, function(key, value){
                            $("#err"+key).text(value).css("color","red");
                        });
                    }
                    if(data.status == "reload"){
                        window.location.href = "{{Route('settings.page')}}";
                    }
                }
            });
            return false;
        });
        $(".SettingFormSubmit5").submit(function(){
            var form = $(".SettingFormSubmit5").get(0);
            $.ajax({
                url : "{{route('settings.update.copyright')}}",
                method: "post",
                data : new FormData(form),
                contentType : false,
                processData : false,
                beforeSend : function(){
                    $(document).find(".form-text").text("");
                },
                success: function(data){
                    if(data.message == "error"){
                        $.each(data.data, function(key, value){
                            $("#err"+key).text(value).css("color","red");
                        });
                    }
                    if(data.status == "reload"){
                        window.location.href = "{{Route('settings.page')}}";
                    }
                }
            });
            return false;
        });
    </script>


    <script type="text/javascript">
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-bottom-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
    
        @if(Session::has('success'))
            toastr.success('{{Session::get('success')}}', 'Success!');
            @php
                Session::forget("success");
            @endphp
        @elseif(Session::has('info'))
            toastr.info('{{Session::get('info')}}', 'Info!')
            @php
                Session::forget("info");
            @endphp
        @elseif(Session::has('warning'))
            toastr.warning('{{Session::get('warning')}}', 'Warning!')
            @php
                Session::forget("warning");
            @endphp
        @elseif(Session::has('error'))
            toastr.error('{{Session::get('error')}}', 'Fail!')
            @php
                Session::forget("error");
            @endphp
        @endif
    
    
    </script>

    {{-- Sidebar Menu Active --}}
    <script type="text/javascript">
        let currentLocation = window.location.pathname;
        let hrefs = $('body .sidebar-menu nav li a.link-item');
        for(let i = 0; i < hrefs.length; i++){
            if(currentLocation === hrefs[i].pathname){
                $(hrefs[i]).closest("li.tree").addClass("active");
                $(hrefs[i]).closest('li.tree').find('ul').addClass('in');
                $(hrefs[i]).addClass("active");
            }
        }
    </script>


    {{-- Stockout Select Search --}}
    <script type="text/javascript">
        function autocompleteSearch() {
            let input, filter, ul, li, a, i;
            input = document.querySelector(".autocompleteSearch");
            filter = input.value.toUpperCase();
            ul = document.querySelector(".autocompleteUl");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];          
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }

        // Select
        let input = document.querySelector(".autocompleteSearch");
        let ul = document.querySelector(".autocompleteUl");
        let li = ul.querySelectorAll("li a");
        for(let i = 0; i < li.length; i++){
            li[i].addEventListener('click',function(){
                // console.log(this.attributes.data_id.value);
                // console.log(this.innerHTML);
                document.querySelector('.autocompleteValue').value = this.attributes.data_id.value;
                document.querySelector('.filter-option-inner-inner').innerHTML = this.innerHTML;
            })
        }

    </script>


    {{-- Date Range Search Validation --}}
    <script type="text/javascript">
        $('.dateRange').submit(function(e){
            let form_date = $(this).find('.form_date').val()
            let to_date = $(this).find('.to_date').val()
            if(form_date > to_date){
                e.preventDefault();
                alert('Form Date Upto To Data');
                return false;
            }else{
                return true;
            }
        })
    </script>