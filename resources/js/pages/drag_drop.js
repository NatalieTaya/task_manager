//Drag and Drop
        let offsetX, offsetY;
        let currentDragItem = null;
        const dropZones = document.querySelectorAll('.drop-zone');
        const dragItems = document.querySelectorAll('.drag-item');
        let isDragging = false;
        let isMouseUp = true;
        const text = document.getElementById('text');
        let itemId;
        let newZone;

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
            itemId = item.getAttribute('id');

        })
       })
        document.addEventListener('mousemove', function(e) {
            if (!isDragging || !currentDragItem || isMouseUp) return;
            currentDragItem.style.left = (e.clientX - offsetX) + 'px';
            currentDragItem.style.top = (e.clientY - offsetY) + 'px';
        });
        document.addEventListener('mouseup', async function(e) {
            if (!isDragging || !currentDragItem) return;
            
            isDragging = false;
            isMouseUp = true;

            // Временно скрываем элемент для точного определения зоны
            currentDragItem.style.visibility = 'hidden';
            const dropZone = document.elementFromPoint(e.clientX, e.clientY)?.closest('.drop-zone');
            currentDragItem.style.visibility = 'visible';

            // Определяем зону (по умолчанию zone-0)
            let targetZone = document.querySelector('#zone-0');
            let zoneName = 'zone-0';
            if (dropZone) {
                targetZone = dropZone;
                zoneName = dropZone.getAttribute('id') ;
            }
            // Перемещаем элемент (один раз!)
            targetZone.appendChild(currentDragItem);
            // Сбрасываем стили
            currentDragItem.style.position = '';
            currentDragItem.style.zIndex = '';
            currentDragItem.style.left = '';
            currentDragItem.style.top = '';

            try {
                const response = await fetch('/update-item-importance', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        item_id: itemId,  // Используем сохранённый ID
                        new_zone: zoneName
                    })
                });
                
                if (!response.ok) {
                    throw new Error('Ошибка сервера');
                }
                
                const result = await response.json();
                console.log('Результат обновления:', result);
                
            } catch (error) {
                console.error('Ошибка при обновлении:', error);
                //  возврат элемента в исходное положение
            }
            // Очищаем ссылку на элемент (после всех операций)
            currentDragItem = null;
        });
        // Защита от случайного перетаскивания при быстрых кликах
        document.addEventListener('dragstart', function(e) {
            if (isDragging) {
                e.preventDefault();
            }
        });