<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatterController;
use App\Http\Controllers\ProductionBatchController;
use App\Http\Controllers\BowlCutterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormingController;
use App\Http\Controllers\FryerController;
use App\Http\Controllers\GrinderController;
use App\Http\Controllers\HltController;
use App\Http\Controllers\KemasanRijekController;
use App\Http\Controllers\MetalDetectorController;
use App\Http\Controllers\MixingController;
use App\Http\Controllers\PackingDalamController;
use App\Http\Controllers\PackingLuarController;
use App\Http\Controllers\PembekuanController;
use App\Http\Controllers\PredustBreaderController;
use App\Http\Controllers\PreparasiFlaController;
use App\Http\Controllers\ProcessTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGroupController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\SuhuRuangController;
use App\Http\Controllers\TumblerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'createLogin'])->name('login');
Route::post('/store', [AuthController::class, 'storeLogin'])->name('login.store');

Route::middleware(['auth'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('password/edit', [AuthController::class, 'edit'])->name('password.edit');
    Route::put('password/update', [AuthController::class, 'update'])->name('password.update');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/production/get-products/{processTypeId}', [ProductionController::class, 'getProducts'])->name('get-products');
    Route::get('/production-batch/by-date/{date}', [ProductionBatchController::class, 'getByDate'])->name('production-batch.by-date');
    Route::get('/dashboard/manager/export', [DashboardController::class, 'exportManager'])->name('dashboard.manager.export');
});

Route::prefix('admin-production')->middleware(['auth', 'role:Admin Production'])->group(function() {
    Route::prefix('product-group')->name('admin-production.product-group.')->group(function () {
        Route::get('/', [ProductGroupController::class, 'index'])->name('index');
        Route::get('/create', [ProductGroupController::class, 'create'])->name('create');
        Route::post('/', [ProductGroupController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductGroupController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProductGroupController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductGroupController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('product')->name('admin-production.product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
        Route::get('/import', [ProductController::class, 'importPage'])->name('import');
        Route::post('/import', [ProductController::class, 'upload'])->name('upload');
    });

    Route::prefix('process-type')->name('admin-production.process-type.')->group(function () {
        Route::get('/', [ProcessTypeController::class, 'index'])->name('index');
        Route::get('/create', [ProcessTypeController::class, 'create'])->name('create');
        Route::post('/', [ProcessTypeController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProcessTypeController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProcessTypeController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProcessTypeController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('operator')->middleware(['auth', 'role:Operator'])->group(function() {
    Route::prefix('production-batch')->group(function () {
        Route::get('/', [ProductionBatchController::class, 'index'])->name('operator.production-batch.index');
        Route::get('/create', [ProductionBatchController::class, 'create'])->name('operator.production-batch.create');
        Route::post('/store', [ProductionBatchController::class, 'store'])->name('operator.production-batch.store');
        Route::get('/{id}/detail', [ProductionBatchController::class, 'detail'])->name('operator.production-batch.detail');
        Route::get('/{id}/edit', [ProductionBatchController::class, 'edit'])->name('operator.production-batch.edit');
        Route::put('/{id}/update', [ProductionBatchController::class, 'update'])->name('operator.production-batch.update');
        Route::delete('/{id}/delete', [ProductionBatchController::class, 'destroy'])->name('operator.production-batch.destroy');
        Route::get('/{id}/export', [ProductionBatchController::class, 'export'])->name('production-batch.export');  
        Route::get('/{id}/export-pdf', [ProductionBatchController::class, 'exportPdf'])->name('operator.production-batch.export-pdf');  
    });
    Route::prefix('production')->group(function () {
        Route::get('/', [ProductionController::class, 'index'])->name('operator.production.index');
        Route::get('/create', [ProductionController::class, 'create'])->name('operator.production.create');
        Route::post('/store', [ProductionController::class, 'store'])->name('operator.production.store');
        Route::get('/{id}/edit', [ProductionController::class, 'edit'])->name('operator.production.edit');
        Route::put('/{id}/update', [ProductionController::class, 'update'])->name('operator.production.update');
        Route::get('/{id}/detail', [ProductionController::class, 'detail'])->name('operator.production.detail');
        Route::delete('/bulk-destroy', [ProductionController::class, 'bulkDestroy'])->name('operator.production.bulk-destroy');
    });

    Route::prefix('bowl-cutter')->name('operator.bowl-cutter.')->group(function () {
        Route::get('/', [BowlCutterController::class, 'index'])->name('index');
        Route::get('/create', [BowlCutterController::class, 'create'])->name('create');
        Route::post('/store', [BowlCutterController::class, 'store'])->name('store');
        Route::get('/{id}/detail', [BowlCutterController::class, 'detail'])->name('detail');
        Route::get('/{id}/edit', [BowlCutterController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [BowlCutterController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [BowlCutterController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('grinder')->group(function () {
        Route::get('/', [GrinderController::class, 'index'])->name('operator.grinder.index');
        Route::get('/create', [GrinderController::class, 'create'])->name('operator.grinder.create');
        Route::post('/store', [GrinderController::class, 'store'])->name('operator.grinder.store');
        Route::get('/{id}/detail', [GrinderController::class, 'detail'])->name('operator.grinder.detail');
        Route::get('/{id}/edit', [GrinderController::class, 'edit'])->name('operator.grinder.edit');
        Route::put('/{id}/update', [GrinderController::class, 'update'])->name('operator.grinder.update');
        Route::delete('/{id}/delete', [GrinderController::class, 'destroy'])->name('operator.grinder.destroy');
    });
    Route::prefix('preparasi-fla')->group(function () {
        Route::get('/', [PreparasiFlaController::class, 'index'])->name('operator.preparasi-fla.index');
        Route::get('/create', [PreparasiFlaController::class, 'create'])->name('operator.preparasi-fla.create');
        Route::post('/store', [PreparasiFlaController::class, 'store'])->name('operator.preparasi-fla.store');
        Route::get('/{id}/detail', [PreparasiFlaController::class, 'detail'])->name('operator.preparasi-fla.detail');
        Route::get('/{id}/edit', [PreparasiFlaController::class, 'edit'])->name('operator.preparasi-fla.edit');
        Route::put('/{id}/update', [PreparasiFlaController::class, 'update'])->name('operator.preparasi-fla.update');
        Route::delete('/{id}/delete', [PreparasiFlaController::class, 'destroy'])->name('operator.preparasi-fla.destroy');
    });

    Route::prefix('mixing')->group(function () {
        Route::get('/', [MixingController::class, 'index'])->name('operator.mixing.index');
        Route::get('/create', [MixingController::class, 'create'])->name('operator.mixing.create');
        Route::post('/store', [MixingController::class, 'store'])->name('operator.mixing.store');
        Route::get('/{id}/detail', [MixingController::class, 'detail'])->name('operator.mixing.detail');
        Route::get('/{id}/edit', [MixingController::class, 'edit'])->name('operator.mixing.edit');
        Route::put('/{id}/update', [MixingController::class, 'update'])->name('operator.mixing.update');
        Route::delete('/{id}/delete', [MixingController::class, 'destroy'])->name('operator.mixing.destroy');
    });

    Route::prefix('tumbler')->group(function () {
        Route::get('/', [TumblerController::class, 'index'])->name('operator.tumbler.index');
        Route::get('/create', [TumblerController::class, 'create'])->name('operator.tumbler.create');
        Route::post('/store', [TumblerController::class, 'store'])->name('operator.tumbler.store');
        Route::get('/{id}/detail', [TumblerController::class, 'detail'])->name('operator.tumbler.detail');
        Route::get('/{id}/edit', [TumblerController::class, 'edit'])->name('operator.tumbler.edit');
        Route::put('/{id}/update', [TumblerController::class, 'update'])->name('operator.tumbler.update');
        Route::delete('/{id}/delete', [TumblerController::class, 'destroy'])->name('operator.tumbler.destroy');
    });

    Route::prefix('forming')->group(function () {
        Route::get('/', [FormingController::class, 'index'])->name('operator.forming.index');
        Route::get('/create', [FormingController::class, 'create'])->name('operator.forming.create');
        Route::post('/store', [FormingController::class, 'store'])->name('operator.forming.store');
        Route::get('/{id}/detail', [FormingController::class, 'detail'])->name('operator.forming.detail');
        Route::get('/{id}/edit', [FormingController::class, 'edit'])->name('operator.forming.edit');
        Route::put('/{id}/update', [FormingController::class, 'update'])->name('operator.forming.update');
        Route::delete('/{id}/delete', [FormingController::class, 'destroy'])->name('operator.forming.destroy');
    });

    Route::prefix('batter')->group(function () {
        Route::get('/', [BatterController::class, 'index'])->name('operator.batter.index');
        Route::get('/create', [BatterController::class, 'create'])->name('operator.batter.create');
        Route::post('/store', [BatterController::class, 'store'])->name('operator.batter.store');
        Route::get('/{id}/detail', [BatterController::class, 'detail'])->name('operator.batter.detail');
        Route::get('/{id}/edit', [BatterController::class, 'edit'])->name('operator.batter.edit');
        Route::put('/{id}/update', [BatterController::class, 'update'])->name('operator.batter.update');
        Route::delete('/{id}/delete', [BatterController::class, 'destroy'])->name('operator.batter.destroy');
    });

    Route::prefix('predust-breader')->group(function () {
        Route::get('/', [PredustBreaderController::class, 'index'])->name('operator.predust-breader.index');
        Route::get('/create', [PredustBreaderController::class, 'create'])->name('operator.predust-breader.create');
        Route::post('/store', [PredustBreaderController::class, 'store'])->name('operator.predust-breader.store');
        Route::get('/{id}/detail', [PredustBreaderController::class, 'detail'])->name('operator.predust-breader.detail');
        Route::get('/{id}/edit', [PredustBreaderController::class, 'edit'])->name('operator.predust-breader.edit');
        Route::put('/{id}/update', [PredustBreaderController::class, 'update'])->name('operator.predust-breader.update');
        Route::delete('/{id}/delete', [PredustBreaderController::class, 'destroy'])->name('operator.predust-breader.destroy');
    });

    Route::prefix('fryer')->group(function () {
        Route::get('/', [FryerController::class, 'index'])->name('operator.fryer.index');
        Route::get('/summary', [FryerController::class, 'summary'])->name('operator.fryer.summary');
        Route::get('/create', [FryerController::class, 'create'])->name('operator.fryer.create');
        Route::post('/store', [FryerController::class, 'store'])->name('operator.fryer.store');
        Route::get('/{id}/detail', [FryerController::class, 'detail'])->name('operator.fryer.detail');
        Route::get('/{id}/edit', [FryerController::class, 'edit'])->name('operator.fryer.edit');
        Route::put('/{id}/update', [FryerController::class, 'update'])->name('operator.fryer.update');
        Route::delete('/{id}/delete', [FryerController::class, 'destroy'])->name('operator.fryer.destroy');
    });

    Route::prefix('hlt')->group(function () {
        Route::get('/', [HltController::class, 'index'])->name('operator.hlt.index');
        Route::get('/create', [HltController::class, 'create'])->name('operator.hlt.create');
        Route::post('/store', [HltController::class, 'store'])->name('operator.hlt.store');
        Route::get('/{id}/detail', [HltController::class, 'detail'])->name('operator.hlt.detail');
        Route::get('/{id}/edit', [HltController::class, 'edit'])->name('operator.hlt.edit');
        Route::put('/{id}/update', [HltController::class, 'update'])->name('operator.hlt.update');
        Route::delete('/{id}/delete', [HltController::class, 'destroy'])->name('operator.hlt.destroy');
    });

    Route::prefix('pembekuan')->group(function () {
        Route::get('/', [PembekuanController::class, 'index'])->name('operator.pembekuan.index');
        Route::get('/summary', [PembekuanController::class, 'summary'])->name('operator.pembekuan.summary');
        Route::get('/create', [PembekuanController::class, 'create'])->name('operator.pembekuan.create');
        Route::post('/store', [PembekuanController::class, 'store'])->name('operator.pembekuan.store');
        Route::get('/{id}/detail', [PembekuanController::class, 'detail'])->name('operator.pembekuan.detail');
        Route::get('/{id}/edit', [PembekuanController::class, 'edit'])->name('operator.pembekuan.edit');
        Route::put('/{id}/update', [PembekuanController::class, 'update'])->name('operator.pembekuan.update');
        Route::delete('/{id}/delete', [PembekuanController::class, 'destroy'])->name('operator.pembekuan.destroy');
    });

    Route::prefix('packing-dalam')->group(function () {
        Route::get('/', [PackingDalamController::class, 'index'])->name('operator.packing-dalam.index');
        Route::get('/create', [PackingDalamController::class, 'create'])->name('operator.packing-dalam.create');
        Route::post('/store', [PackingDalamController::class, 'store'])->name('operator.packing-dalam.store');
        Route::get('/{id}/detail', [PackingDalamController::class, 'detail'])->name('operator.packing-dalam.detail');
        Route::get('/{id}/edit', [PackingDalamController::class, 'edit'])->name('operator.packing-dalam.edit');
        Route::put('/{id}/update', [PackingDalamController::class, 'update'])->name('operator.packing-dalam.update');
        Route::delete('/{id}/delete', [PackingDalamController::class, 'destroy'])->name('operator.packing-dalam.destroy');
    });

    Route::prefix('metal-detector')->group(function () {
        Route::get('/', [MetalDetectorController::class, 'index'])->name('operator.metal-detector.index');
        Route::get('/create', [MetalDetectorController::class, 'create'])->name('operator.metal-detector.create');
        Route::post('/store', [MetalDetectorController::class, 'store'])->name('operator.metal-detector.store');
        Route::get('/{id}/detail', [MetalDetectorController::class, 'detail'])->name('operator.metal-detector.detail');
        Route::get('/{id}/edit', [MetalDetectorController::class, 'edit'])->name('operator.metal-detector.edit');
        Route::put('/{id}/update', [MetalDetectorController::class, 'update'])->name('operator.metal-detector.update');
        Route::delete('/{id}/delete', [MetalDetectorController::class, 'destroy'])->name('operator.metal-detector.destroy');
    });

    Route::prefix('packing-luar')->group(function () {
        Route::get('/', [PackingLuarController::class, 'index'])->name('operator.packing-luar.index');
        Route::get('/create', [PackingLuarController::class, 'create'])->name('operator.packing-luar.create');
        Route::post('/store', [PackingLuarController::class, 'store'])->name('operator.packing-luar.store');
        Route::get('/{id}/detail', [PackingLuarController::class, 'show'])->name('operator.packing-luar.detail');
        Route::get('/{id}/edit', [PackingLuarController::class, 'edit'])->name('operator.packing-luar.edit');
        Route::put('/{id}/update', [PackingLuarController::class, 'update'])->name('operator.packing-luar.update');
        Route::delete('/{id}/delete', [PackingLuarController::class, 'destroy'])->name('operator.packing-luar.destroy');
    });

    Route::prefix('kemasan-rijek')->group(function () {
        Route::get('/', [KemasanRijekController::class, 'index'])->name('operator.kemasan-rijek.index');
        Route::get('/create', [KemasanRijekController::class, 'create'])->name('operator.kemasan-rijek.create');
        Route::post('/store', [KemasanRijekController::class, 'store'])->name('operator.kemasan-rijek.store');
        Route::get('/{id}/detail', [KemasanRijekController::class, 'detail'])->name('operator.kemasan-rijek.detail');
        Route::get('/{id}/edit', [KemasanRijekController::class, 'edit'])->name('operator.kemasan-rijek.edit');
        Route::put('/{id}/update', [KemasanRijekController::class, 'update'])->name('operator.kemasan-rijek.update');
        Route::delete('/{id}/delete', [KemasanRijekController::class, 'destroy'])->name('operator.kemasan-rijek.destroy');
    });

    Route::prefix('suhu-ruang')->name('operator.suhu-ruang.')->group(function () {
        Route::get('/', [SuhuRuangController::class, 'index'])->name('index');
        Route::get('/create', [SuhuRuangController::class, 'create'])->name('create');
        Route::post('/', [SuhuRuangController::class, 'store'])->name('store');
        Route::get('/{id}/detail', [SuhuRuangController::class, 'detail'])->name('detail');
        Route::get('/{id}/edit', [SuhuRuangController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SuhuRuangController::class, 'update'])->name('update');
        Route::delete('/{id}', [SuhuRuangController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('manager')->middleware(['auth', 'role:Manager,General Manager'])->group(function() {
    Route::prefix('production-batch')->group(function () {
        Route::get('/', [ProductionBatchController::class, 'managerIndex'])->name('manager.production-batch.index');
        Route::get('/{id}/detail', [ProductionBatchController::class, 'managerDetail'])->name('manager.production-batch.detail');
        Route::get('/{id}/export', [ProductionBatchController::class, 'managerExport'])->name('manager.production-batch.export');
        Route::get('/{id}/export-pdf', [ProductionBatchController::class, 'managerExportPdf'])->name('manager.production-batch.export-pdf');
    });
        Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('manager.user.index');
        Route::get('/create', [UserController::class, 'create'])->name('manager.user.create');
        Route::post('/store', [UserController::class, 'store'])->name('manager.user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('manager.user.edit');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('manager.user.update');
        Route::delete('/{id}/delete', [UserController::class, 'destroy'])->name('manager.user.destroy');
    });

    Route::prefix('production')->group(function () {
        Route::get('/', [ProductionController::class, 'managerIndex'])->name('manager.production.index');
        Route::get('/{id}/detail', [ProductionController::class, 'managerDetail'])->name('manager.production.detail');
    });

    Route::prefix('bowl-cutter')->name('manager.bowl-cutter.')->group(function () {
        Route::get('/', [BowlCutterController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [BowlCutterController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('grinder')->name('manager.grinder.')->group(function () {
        Route::get('/', [GrinderController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [GrinderController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('preparasi-fla')->name('manager.preparasi-fla.')->group(function () {
        Route::get('/', [PreparasiFlaController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [PreparasiFlaController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('mixing')->name('manager.mixing.')->group(function () {
        Route::get('/', [MixingController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [MixingController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('tumbler')->name('manager.tumbler.')->group(function () {
        Route::get('/', [TumblerController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [TumblerController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('forming')->name('manager.forming.')->group(function () {
        Route::get('/', [FormingController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [FormingController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('batter')->name('manager.batter.')->group(function () {
        Route::get('/', [BatterController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [BatterController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('predust-breader')->name('manager.predust-breader.')->group(function () {
        Route::get('/', [PredustBreaderController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [PredustBreaderController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('fryer')->name('manager.fryer.')->group(function () {
        Route::get('/', [FryerController::class, 'managerIndex'])->name('index');
        Route::get('/summary', [FryerController::class, 'managerSummary'])->name('summary');
        Route::get('/{id}/detail', [FryerController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('hlt')->name('manager.hlt.')->group(function () {
        Route::get('/', [HltController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [HltController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('pembekuan')->name('manager.pembekuan.')->group(function () {
        Route::get('/', [PembekuanController::class, 'managerIndex'])->name('index');
        Route::get('/summary', [PembekuanController::class, 'managerSummary'])->name('summary');
        Route::get('/{id}/detail', [PembekuanController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('packing-dalam')->name('manager.packing-dalam.')->group(function () {
        Route::get('/', [PackingDalamController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [PackingDalamController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('metal-detector')->name('manager.metal-detector.')->group(function () {
        Route::get('/', [MetalDetectorController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [MetalDetectorController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('packing-luar')->name('manager.packing-luar.')->group(function () {
        Route::get('/', [PackingLuarController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [PackingLuarController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('kemasan-rijek')->name('manager.kemasan-rijek.')->group(function () {
        Route::get('/', [KemasanRijekController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [KemasanRijekController::class, 'managerDetail'])->name('detail');
    });

    Route::prefix('suhu-ruang')->name('manager.suhu-ruang.')->group(function () {
        Route::get('/', [SuhuRuangController::class, 'managerIndex'])->name('index');
        Route::get('/{id}/detail', [SuhuRuangController::class, 'managerDetail'])->name('detail');
    });
});