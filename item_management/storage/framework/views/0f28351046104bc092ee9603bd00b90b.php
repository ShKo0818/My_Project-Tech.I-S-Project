

<?php $__env->startSection('title', '商品詳細'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>商品詳細</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3><?php echo e($item->name); ?></h3>
                    <p><strong>種別:</strong> <?php echo e($item->type); ?></p>
                    <p><strong>詳細:</strong> <?php echo e($item->detail); ?></p>
                    <p><strong>メーカー名:</strong> <?php echo e($item->company_name); ?></p>
                    <p><strong>商品カテゴリ:</strong> <?php echo e($item->category); ?></p>
                    <p><strong>画像:</strong>
                    <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>">
                    <input type="hidden" name="name" value="<?php echo e($item->name); ?>">
                    <input type="hidden" name="price" value="<?php echo e($item->price); ?>">
                    <input type="hidden" name="image" value="<?php echo e(asset('storage/' . $item->image)); ?>">

                    <label for="quantity">数量：</label>
                    <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display:inline;">
                    <button type="submit" class="btn btn-success">カートに追加</button>
                </form>

    <?php if($item->image): ?>
        <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="Product Image" style="max-width: 50%; height: auto;">
    <?php else: ?>
        <p>画像がありません</p>
    <?php endif; ?>
</p>

                
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/item/show.blade.php ENDPATH**/ ?>