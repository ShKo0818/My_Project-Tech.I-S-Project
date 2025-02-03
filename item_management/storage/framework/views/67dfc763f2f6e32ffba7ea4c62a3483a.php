

<?php $__env->startSection('title', '商品編集'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>商品編集</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('item.update', $item->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PATCH'); ?>  <!-- 'PUT' を 'PATCH' に変更 -->

    <div class="form-group">
        <label for="name">商品名</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo e($item->name); ?>" required>
    </div>

    <div class="form-group">
        <label for="price">価格</label>
        <input type="number" class="form-control" id="price" name="price" value="<?php echo e($item->price); ?>" required min="0">
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

    <div class="form-group">
        <label for="image">商品画像</label>
        <div>
            <!-- 現在の画像を表示 -->
            <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="商品画像" width="150">
        </div>
        <input type="file" class="form-control" id="image" name="image">
    </div>

    <button type="submit" class="btn btn-success">更新する</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/item/edit.blade.php ENDPATH**/ ?>