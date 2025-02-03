

<?php $__env->startSection('title', '発注ページ'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>発注者ページ</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('order.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <!-- 商品名（選択） -->
        <div class="form-group">
            <label for="item_name">商品名</label>
            <select class="form-control" id="item_name" name="item_name" required>
                <option value="">商品名を選択　商品登録された商品がここに表示されます</option>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- 発注数 -->
        <div class="form-group">
            <label for="quantity">発注数</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required min="1" placeholder="発注数を入力（実際はメーカーによって１個から、１ダースからと違いがあるが仮定の状況なので仮定">
        </div>

        <!-- 金額 -->
        <div class="form-group">
            <label for="price">金額（1商品あたり）</label>
            <input type="number" class="form-control" id="price" name="price" required min="0" placeholder="金額を入力(実際の商品管理の場合は原価設定なども必要ですが仮定の状況なので仮定)">
        </div>

        <!-- カテゴリ選択 -->
        <div class="form-group">
            <label for="category">カテゴリ</label>
            <select class="form-control" id="category" name="category" required>
                <option value="">カテゴリを選択</option>
                <option value="vegetable">野菜</option>
                <option value="fruit">フルーツ</option>
                <option value="flower">花</option>
                <option value="other">その他</option>
            </select>
        </div>

        <!-- メーカー名（法人ユーザーの名前を自動入力） -->
        <div class="form-group">
            <label for="company_name">メーカー名</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo e(auth()->user()->company_name); ?>" readonly>
        </div>

        <!-- 発注確認 -->
        <button type="submit" class="btn btn-success">発注する</button>
        <a href="<?php echo e(route('order.create')); ?>" class="btn btn-danger">戻る</a>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/orders/order.blade.php ENDPATH**/ ?>