<?php $__env->startSection('title', 'Edit Task'); ?>
<?php $__env->startSection('content'); ?>
<main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Task</h2>
        <p class="text-gray-600">Update task details</p>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <form class="p-6" method="POST" action="<?php echo e(route('tasks.update', $task->id)); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Error Messages -->
            <?php if($errors->any()): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="col-span-1 md:col-span-2">
                    <label for="task-name" class="block text-sm font-medium text-gray-700 mb-2">Task Name</label>
                    <input type="text" id="task-name" name="task_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?php echo e(old('task_name', $task->task_name)); ?>" required>
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                    <select id="priority" name="priority" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="low" <?php echo e($task->priority == 'low' ? 'selected' : ''); ?>>Low</option>
                        <option value="medium" <?php echo e($task->priority == 'medium' ? 'selected' : ''); ?>>Medium</option>
                        <option value="high" <?php echo e($task->priority == 'high' ? 'selected' : ''); ?>>High</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="not-started" <?php echo e(old('status', $task->status) == 'not-started' ? 'selected' : ''); ?>>Not Started</option>
                        <option value="in-progress" <?php echo e(old('status', $task->status) == 'in-progress' ? 'selected' : ''); ?>>In Progress</option>
                        <option value="completed" <?php echo e(old('status', $task->status) == 'completed' ? 'selected' : ''); ?>>Completed</option>
                    </select>
                </div>

                <div>
                    <label for="due-date" class="block text-sm font-medium text-gray-700 mb-2">Due Date</label>
                    <input type="date" id="due-date" name="due_date" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?php echo e(old('due_date', $task->due_date)); ?>">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"><?php echo e(old('description', $task->description)); ?></textarea>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Add New Attachments</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="image" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF up to 10MB
                                </p>
                            </div>
                        </div>
                        <?php if($task->image): ?>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600">Current file: <a href="<?php echo e(asset('storage/' . $task->image)); ?>" class="text-blue-600"><?php echo e(basename($task->image)); ?></a></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-3">
                <a href="<?php echo e(route('tasks.index')); ?>" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:text-gray-500 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">Save Changes</button>
            </div>
        </form>
    </div>
    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.task', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/azizbek/Desktop/ORM/resources/views/task_crud/edit.blade.php ENDPATH**/ ?>