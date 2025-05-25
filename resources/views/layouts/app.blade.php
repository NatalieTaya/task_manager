<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="py-5 px-5">
    <div class="flex py-5 px-5 m">
        <div class="btn flex-1">Create task</div>
        <div class="btn flex-1">Show all finished tasks</div>
    </div>
    <div class="flex">
        <div id="zone-0" class="drop-zone task_block flex-1">
            <h2 class="title">Not sorted tasks</h2>
            <div id="elem" draggable="true" class="drag-item absolute px-3 py-3 w-20 bg-violet-700">мой элемент</div>
        </div>
        <div  id="zone-1" class="drop-zone task_block task_block_im flex-1"><h2 class="title">Important tasks</h2></div>
        <div  id="zone-2" class="drop-zone task_block task_block_ss flex-1"><h2 class="title">So-so important tasks</h2></div>
        <div  id="zone-3" class="drop-zone task_block task_block_ni flex-1"><h2 class="title">Not important tasks</h2></div>
    </div>


    <script>
        //Drag and Drop
        const dropZones = document.querySelectorAll('.drop-zone');
        const dragItems = document.querySelectorAll('.drag-item');
        const dragItem = document.getElementById('elem'); 

        // События для перетаскиваемого элемента
        dragItems.forEach(item => {
            item.addEventListener('dragstart', function(e) {
                e.dataTransfer.setData('text/plain', this.id);
                setTimeout(() => this.classList.add('dragging'), 0);
            });
            item.addEventListener('dragend', function() {
                this.classList.remove('dragging');
            });
        })


        // События для зоны сброса
        dropZones.forEach(zone => {
            zone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-6', 'border-red-500');
            });
            zone.addEventListener('dragleave', function() {
                this.classList.remove('border-6', 'border-red-500');
            });
            zone.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('border-6', 'border-red-500');
                
                const id = e.dataTransfer.getData('text/plain');
                const draggedElement = document.getElementById(id);
                
                // Проверяем, что это наш элемент
                if (draggedElement === dragItem) {
                // Добавляем элемент в зону 
                this.appendChild(draggedElement);
                }
            });
        });
    </script>

</body>
</html>