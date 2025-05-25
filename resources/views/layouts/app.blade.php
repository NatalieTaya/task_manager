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
        <div id="zone-0" class=" drop-zone relative task_block flex-1">
            <h2 class="title">Not sorted tasks</h2>
            <div id="text" ></div>
        </div>
        <div  id="zone-1" class="drop-zone relative task_block task_block_im flex-1">
            <h2 class="title">   Important tasks</h2>            
            <div id="elem" draggable="true" class="drag-item px-3 py-3 w-20 bg-violet-700">мой элемент</div>
        </div>
        <div  id="zone-2" class="drop-zone relative task_block task_block_ss flex-1"><h2 class="title">So-so important tasks</h2></div>
        <div  id="zone-3" class="drop-zone relative task_block task_block_ni flex-1"><h2 class="title">Not important tasks</h2></div>
    </div>


    <script>
        //Drag and Drop
        let offsetX, offsetY;
        let currentDragItem = null;
        const dropZones = document.querySelectorAll('.drop-zone');
        const dragItems = document.querySelectorAll('.drag-item');
        let isDragging = false;
        let isMouseUp = true;
        const text = document.getElementById('text');

       dragItems.forEach(item => {
        item.addEventListener('mousedown', function(e) {
            if (!isMouseUp) return;
            isMouseUp=false
            isDragging=true
            const rect = item.getBoundingClientRect()
            offsetX = e.clientX - rect.left
            offsetY = e.clientY - rect.top
            currentDragItem=item
            item.style.position = 'absolute';
            item.style.zIndex='1000'
            document.body.appendChild(item); // Перемещаем в body для свободного перемещения
        })
       })
        document.addEventListener('mousemove', function(e) {
            if (!isDragging || !currentDragItem || isMouseUp) return;
            currentDragItem.style.left = (e.clientX - offsetX) + 'px';
            currentDragItem.style.top = (e.clientY - offsetY) + 'px';
        });
        document.addEventListener('mouseup', function(e) {
            if (!isDragging || !currentDragItem ) return;
            isDragging=false
            isMouseUp = true;
            // Временно скрываем элемент для точного определения зоны
            currentDragItem.style.visibility = 'hidden';
            const dropZone = document.elementFromPoint(e.clientX, e.clientY)?.closest('.drop-zone');
            currentDragItem.style.visibility = 'visible';
            if (dropZone) {
                    dropZone.appendChild(currentDragItem);
            }else {
                document.querySelector('#zone-1').appendChild(currentDragItem);
            }
                // 3. Сбрасываем стили
            currentDragItem.style.position = '';
            currentDragItem.style.zIndex = '';
            currentDragItem.style.left = '';
            currentDragItem.style.top = '';

            // 4. Очищаем ссылку на элемент
            currentDragItem = null;
        });
        // Защита от случайного перетаскивания при быстрых кликах
            document.addEventListener('dragstart', function(e) {
                if (isDragging) {
                    e.preventDefault();
                }
            });
    </script>

</body>
</html>