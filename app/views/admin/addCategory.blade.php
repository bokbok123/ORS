
<script type="text/javascript" src="{{ Theme::asset()->url('js/user/billerAddCategory.js') }}"></script>

{{ Theme::asset()->usePath()->add('css-magnifier', 'css/addCategory.css') }} {{ Theme::asset()->usePath()->add('css-user-receipt_view', 'css/user/addCategory.css') }}
<div id="errorDiv">

    @if ($Status =='Save')
    <div class="row alert alert-success">
        <label class="control-label" for="inputSuccess1">Category has been Sucessfully saved</label>
    </div>
    @endif
    @if ($Status =='Error')
    <div class="row alert alert-danger" style="display:none;">
        <label class="control-label" for="inputSuccess1"></label>
    </div>
    @endif
</div>
<div>
	<h1>Bill Category</h1>
	<div id="content">

		<form action=add id="form" method="post">

			<br>
			<input type='text' class='form-control input-sm' placeholder="Bill" id="category" name = "category">

			<br>
			<input type='text' class='form-control input-sm' placeholder="Description" id="description" name = "description">
			<br>
			<a class="btn btn-info btn-large" id="save"> Save </a>
		</form>

	</div>
</div>
