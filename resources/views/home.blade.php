@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @foreach($products as $one)
                    <div class="col-md-8 product-item">
                        <input type="hidden" value="{{ $one->id }}" class="product-id" />
                        <input type="hidden" value="{{ $one->title }}" class="product-title" />
                        <h3>{{ $one->title }}</h3>
                        <div class="col-md-10">
                            {{ $one->body }}
                            <a href="" class="btn btn-success small add_to_cart">Add to cart</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="col-md-12" id="cart-info"></div>
            <div class="col-md-12">

            </div>
        </div>

    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $(".add_to_cart").on("click", function (e) {
        e.preventDefault();
        if ($(this).hasClass("btn-success")) {
            $(this).removeClass("btn-success").addClass("btn-default").html("Undo");
            var $id = $(this).closest(".product-item").find(".product-id").val();
            var $title = $(this).closest(".product-item").find(".product-title").val();
            var content = "";
            content += "<h5 id='tr_" + $id + "'>" + $title + "</h5>";
            $("#cart-info").append(content);
            cart_process($id);
        } else {
            $(this).removeClass("btn-default").addClass("btn-success").html("Add to cart");
            var $thisid = $(this).closest(".product-item").find(".product-id").val();
            cart_process($thisid);
            $("#tr_" + $thisid).remove();
        }
    });
});
function cart_process(id) {
    $.ajax({
        url: "{{ url('/add_to_cart') }}" + "/" + id,
        type: "get",
        data: {},
        success: function (msg) {
            console.log(msg);
//            alert("Successfull operation");
        }
    });
}
</script>