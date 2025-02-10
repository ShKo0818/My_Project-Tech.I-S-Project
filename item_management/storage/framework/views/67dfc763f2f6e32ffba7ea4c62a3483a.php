  

<?php $__env->startSection('title', '商品編集'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>商品編集</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('item.update', $item->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PATCH'); ?>

    <div class="form-group">
        <label for="name">商品名</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo e($item->name); ?>" required oninput="checkNameLength()">
        <small id="nameError" class="text-danger" style="display:none;">商品名は30文字以内で入力してください</small>
        <small id="spaceError" class="text-danger" style="display:none;">商品名にスペースは含めないでください</small>
    </div>

    <div class="form-group">
        <label for="price">価格</label>
        <input type="number" class="form-control" id="price" name="price" value="<?php echo e($item->price); ?>" required min="0" oninput="checkPrice()">
        <small id="priceError" class="text-danger" style="display:none;">価格は999,999円以内で入力してください</small>
    </div>

    <div class="form-group">
        <label for="category">カテゴリ</label>
        <select class="form-control" id="category" name="category_id" required>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php if($item->category_id == $category->id): ?> selected <?php endif; ?>>
                    <?php echo e($category->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <button type="submit" class="btn btn-success" id="submitButton" disabled>更新する</button>
</form>
<?php $__env->stopSection(); ?>

<script>
// 商品名の入力欄を取得
const nameInput = document.getElementById('name');
const priceInput = document.getElementById('price');
const submitButton = document.getElementById('submitButton');

// 商品名を入力したときにチェックを実行
function checkNameLength() {
    const name = nameInput.value;
    const nameError = document.getElementById('nameError');
    const spaceError = document.getElementById('spaceError');

    // 半角スペースと全角スペースの両方をチェック
    const spacePattern = /[\s\u3000]/;  // 半角または全角スペースを含むかどうかの正規表現

    // スペースが含まれているか確認
    if (spacePattern.test(name)) {
        spaceError.style.display = 'block';
        submitButton.disabled = true; // ボタンを無効化
    } else {
        spaceError.style.display = 'none';
    }

    // 商品名が30文字を超えていないかチェック
    if (name.length > 30) {
        nameError.style.display = 'block';
        submitButton.disabled = true; // ボタンを無効化
    } else {
        nameError.style.display = 'none';
    }

    // 商品名が変更されて、スペースが含まれていない場合、ボタンを有効化
    if (name.length <= 30 && !spacePattern.test(name)) {
        checkPrice(); // 価格のチェックも行う
    } else {
        submitButton.disabled = true;
    }
}

// 価格が999,999円以上でないかチェック
function checkPrice() {
    const price = priceInput.value;
    const priceError = document.getElementById('priceError');

    if (price >= 1000000) {
        priceError.style.display = 'block';
        submitButton.disabled = true; // ボタンを無効化
    } else {
        priceError.style.display = 'none';
    }

    // 商品名の長さも再確認
    const name = nameInput.value;
    if (name.length <= 30 && price < 1000000 && !/[\s\u3000]/.test(name)) {
        submitButton.disabled = false; // 両方の条件を満たせばボタンを有効化
    }
}
</script>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/item/edit.blade.php ENDPATH**/ ?>