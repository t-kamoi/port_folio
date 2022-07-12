<!-- <?php
	$i = array("a","2"=>"b","c","d","e","5"=>"f");
	$j = array(1,2,3);
	print_r($i);
?>


<nav aria-label="標準のページ送りの例">
	<ul class="pagination">
		<li class="page-item"><a class="page-link" href="#" aria-label="前へ"><span aria-hidden="true">«</span></a></li>
		<li class="page-item"><a class="page-link" href="#">1</a></li>
		<li class="page-item"><a class="page-link" href="#">2</a></li>
		<li class="page-item"><a class="page-link" href="#">3</a></li>
		<li class="page-item"><a class="page-link" href="#" aria-label="次へ"><span aria-hidden="true">»</span></a></li>
	</ul>
</nav>

<nav aria-label="大きめページ送りの例">
	<ul class="pagination pagination-lg flex-wrap">
		<li class="page-item disabled"><a class="page-link">前へ</a></li>
		<li class="page-item"><a class="page-link" href="#">1</a></li>
		<li class="page-item active" aria-current="page"><a class="page-link" href="#">2</a></li>
		<li class="page-item"><a class="page-link" href="#">3</a></li>
		<li class="page-item"><a class="page-link" href="#">次へ</a></li>
	</ul>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mt-5">
	<div class="container-fluid">
		<a class="navbar-brand" href="#"><img src="../images/bootstrap-logo-white.svg" width="38" height="30" class="d-inline-block align-top" alt="Bootstrap" loading="lazy"></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="ナビゲーションの切替"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent2">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">ホーム</a></li>
				<li class="nav-item"><a class="nav-link" href="#">リンク</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">ドロップダウン</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
					<li><a class="dropdown-item" href="#">メニュー1</a></li>
					<li><a class="dropdown-item" href="#">メニュー2</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="#">その他リンク</a></li>
					</ul>
				</li>
				<li class="nav-item"><a class="nav-link disabled">無効</a></li>
			</ul>
			<form class="d-flex" role="search">
				<input class="form-control me-2" type="search" placeholder="検索" aria-label="検索">
				<button class="btn btn-outline-light flex-shrink-0" type="submit">検索</button>
			</form>
		</div>
	</div>
</nav>

<div class="mb-3">
	<label for="exampleInputEmail1" class="form-label">Eメールアドレス</label>
	<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
	<div id="emailHelp" class="form-text">あなたのメールを他の人と共有することは決してありません。</div>
</div>

<div class="input-group">
	<span class="input-group-text">textarea付き</span>
	<textarea class="form-control" aria-label="textarea付き" data-dl-input-translation="true"></textarea>
</div>

<div>
        <div class="bd-example">
        
        <button type="button" class="btn btn-primary">Primary</button>
        <button type="button" class="btn btn-secondary">Secondary</button>
        <button type="button" class="btn btn-success">Success</button>
        <button type="button" class="btn btn-danger">Danger</button>
        <button type="button" class="btn btn-warning">Warning</button>
        <button type="button" class="btn btn-info">Info</button>
        <button type="button" class="btn btn-light">Light</button>
        <button type="button" class="btn btn-dark">Dark</button>

        <button type="button" class="btn btn-link">Link</button>
        </div>

        <div class="bd-example">
        
        <button type="button" class="btn btn-outline-primary">Primary</button>
        <button type="button" class="btn btn-outline-secondary">Secondary</button>
        <button type="button" class="btn btn-outline-success">Success</button>
        <button type="button" class="btn btn-outline-danger">Danger</button>
        <button type="button" class="btn btn-outline-warning">Warning</button>
        <button type="button" class="btn btn-outline-info">Info</button>
        <button type="button" class="btn btn-outline-light">Light</button>
        <button type="button" class="btn btn-outline-dark">Dark</button>
        </div>

        <div class="bd-example">
        <button type="button" class="btn btn-primary btn-sm">小さめのボタン</button>
        <button type="button" class="btn btn-primary">標準のボタン</button>
        <button type="button" class="btn btn-primary btn-lg">大きめのボタン</button>
        </div>
</div>

<div class="col-md-6">
	<label for="validationServer03" class="form-label">市(City)</label>
	<input type="text" class="form-control is-invalid" id="validationServer03" required="">
	<div class="invalid-feedback">
		有効な市を入力してください
	</div>
</div>

<div class="mb-3">
	<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg 大きめの選択メニュー">
		<option selected="">この選択メニューを開く</option>
		<option value="1">その1</option>
		<option value="2">その2</option>
		<option value="3">その3</option>
	</select>
</div>

<fieldset class="mb-3">
	<legend>ラジオボタン</legend>
		<div class="form-check">
			<input type="radio" name="radios" class="form-check-input" id="exampleRadio1">
			<label class="form-check-label" for="exampleRadio1">通常のラジオボタン</label>
		</div>
		<div class="mb-3 form-check">
			<input type="radio" name="radios" class="form-check-input" id="exampleRadio2">
			<label class="form-check-label" for="exampleRadio2">もう一つのラジオボタン</label>
		</div>
</fieldset> -->

<?php
$items = filter_input(INPUT_GET,"items",FILTER_DEFAULT,FILTER_REQUIRE_ARRAY)?:[];
$checked["items"]=["A"=>"","B"=>"","C"=>"","D"=>""];
foreach($items as $val){
	$checked["items"][$val]=" checked";
}
echo '<pre>';
var_dump($items);
var_dump($checked);
echo '</pre>';
?>
<form>
<label><input type="checkbox" name="items[]" value="A"<?=$checked["items"]["A"]?>>A</label>
<label><input type="checkbox" name="items[]" value="B"<?=$checked["items"]["B"]?>>B</label>
<label><input type="checkbox" name="items[]" value="C"<?=$checked["items"]["C"]?>>C</label>
<label><input type="checkbox" name="items[]" value="D"<?=$checked["items"]["D"]?>>D</label><br>
<input type="submit" value="send">
</form>