$(document).ready(function() {

    // Инфа о выбранных файлах
    var countInfo = $("#info-count");
    var sizeInfo = $("#info-size");

    // ul-список, содержащий миниатюрки выбранных файлов
    var imgList = $('#photo-items');

    // Счетчик всех выбранных файлов и их размера
    var imgCount = 0;
    var imgSize = 0;

    // Стандарный input для файлов
    var fileInput = $('#file-field');

    ////////////////////////////////////////////////////////////////////////////
    // Подключаем и настраиваем плагин загрузки

    fileInput.damnUploader({
        // куда отправлять
        url: '/cube/qwer/index.php?r=post/photoItemUpload',
        // имитация имени поля с файлом (будет ключом в $_FILES, если используется PHP)
        fieldName:  'my-pic',
        // максимальное кол-во выбранных файлов (если не указано - без ограничений)
        limit: 5,
        // когда максимальное кол-во достигнуто (вызывается при каждой попытке добавить еще файлы)
        onLimitExceeded: function() {
            console.log('Допустимое кол-во файлов уже выбрано');
        },
        // ручная обработка события выбора файла (в случае, если выбрано несколько, будет вызвано для каждого)
        // если обработчик возвращает true, файлы добавляются в очередь автоматически
        onSelect: function(file) {
            addFileToQueue(file);
            return false;
        },
        // когда все загружены
        onAllComplete: function() {
            console.log('Все загрузки завершены!');
            imgCount = 0;
            imgSize = 0;
            updateInfo();
        }
    });



    ////////////////////////////////////////////////////////////////////////////
    // Вывод инфы о выбранных
    function updateInfo() {
        countInfo.text( (imgCount == 0) ? 'Изображений не выбрано' : ('Изображений выбрано: '+imgCount));
        sizeInfo.text( (imgSize == 0) ? '-' : Math.round(imgSize / 1024));
    }

    // Обновление progress bar'а
    function updateProgress(bar, value) {
        var width = bar.width();
        var bgrValue = -width + (value * (width / 100));
        bar.attr('rel', value).css('background-position', bgrValue+'px center').text(value+'%');
    }

    // преобразование формата dataURI в Blob-данные
    function dataURItoBlob(dataURI) {
        var BlobBuilder = (window.MSBlobBuilder || window.MozBlobBuilder || window.WebKitBlobBuilder || window.BlobBuilder);
        if (!BlobBuilder) {
            return false;
        }
        // convert base64 to raw binary data held in a string
        // doesn't handle URLEncoded DataURIs
        var pieces = dataURI.split(',');
        var byteString = (pieces[0].indexOf('base64') >= 0) ? atob(pieces[1]) : unescape(pieces[1]);
        // separate out the mime component
        var mimeString = pieces[0].split(':')[1].split(';')[0];
        // write the bytes of the string to an ArrayBuffer
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        // write the ArrayBuffer to a blob, and you're done
        var bb = new BlobBuilder();
        bb.append(ab);
        return bb.getBlob(mimeString);
    }



    // Отображение выбраных файлов, создание миниатюр и ручное добавление в очередь загрузки.
    function addFileToQueue(file) {

        // Создаем элемент li и помещаем в него название, миниатюру и progress bar
        var li = $('<li/>').appendTo(imgList);
        var title = $('<div/>').text(file.name+' ').appendTo(li);
        var cancelButton = $('<a/>').attr({
            href: '#cancel',
            title: 'отменить'
        }).text('X').appendTo(title);
        // Кнопку для загрузки фоток делаем видимой
        $('#upload-all').show();
        // Если браузер поддерживает выбор файлов (иначе передается специальный параметр fake,
        // обозночающий, что переданный параметр на самом деле лишь имитация настоящего File)
        if(!file.fake) {

            // Отсеиваем не картинки
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                log('Файл отсеян: `'+file.name+'` (тип '+file.type+')');
                return true;
            }

            // Добавляем картинку и прогрессбар в текущий элемент списка
            var img = $('<img/>').appendTo(li);
            var pBar = $('<div/>').addClass('progress').attr('rel', '0').text('0%').appendTo(li);

            // Создаем объект FileReader и по завершении чтения файла, отображаем миниатюру и обновляем
            // инфу обо всех файлах (только в браузерах, подерживающих FileReader)
            if($.support.fileReading) {
                var reader = new FileReader();
                reader.onload = (function(aImg) {
                    return function(e) {
                        aImg.attr('src', e.target.result);
                        aImg.attr('width', 150);
                    };
                })(img);
                reader.readAsDataURL(file);
            }

            console.log('Картинка добавлена: `'+file.name + '` (' +Math.round(file.size / 1024) + ' Кб)');
            imgSize += file.size;
        } else {
            console.log('Файл добавлен: '+file.name);
        }

        imgCount++;
        updateInfo();

        // Создаем объект загрузки
        var uploadItem = {
            file: file,
            onProgress: function(percents) {
                updateProgress(pBar, percents);
            },
            onComplete: function(successfully, data, errorCode) {
                if(successfully) {
                    console.log('Файл `'+this.file.name+'` загружен, полученные данные:<br/>*****<br/>'+data+'<br/>*****');
                } else {
                    if(!this.cancelled) {
                        console.log('Файл `'+this.file.name+'`: ошибка при загрузке. Код: '+errorCode);
                    }
                }
            }
        };

        // ... и помещаем его в очередь
        var queueId = fileInput.damnUploader('addItem', uploadItem);

        // обработчик нажатия ссылки "отмена"
        cancelButton.click(function() {
            fileInput.damnUploader('cancel', queueId);
            li.remove();
            imgCount--;
            imgSize -= file.fake ? 0 : file.size;
            updateInfo();
            console.log(file.name+' удален');
            return false;
        });

        return uploadItem;
    }

    // Обаботка события нажатия на кнопку "Загрузить все".
    // стартуем все загрузки
/*    $("#submit-btn").trigger(function() {
        fileInput.damnUploader('startUpload');*/
    /*    $(this).hide();*/
       /* $('.form-photo').hide()*/
 /*   }, function() {
        $(this).click();
    });*/
    $("#upload-all").click(function() {
        $(this).hide();
        $('.form-photo').hide();
        fileInput.damnUploader('startUpload');
    });

    ////////////////////////////////////////////////////////////////////////////
    // Проверка поддержки File API, FormData и FileReader

    if(!$.support.fileSelecting) {
        console.log('Ваш браузер не поддерживает выбор файлов (загрузка будет осуществлена обычной отправкой формы)');
        $("#dropBox-label").text('если бы ты использовал хороший браузер, файлы можно было бы перетаскивать прямо в область ниже!');
    } else {
        if(!$.support.fileReading) {
            console.log('* Ваш браузер не умеет читать содержимое файлов (миниатюрки не будут показаны)');
        }
        if(!$.support.uploadControl) {
            console.log('* Ваш браузер не умеет следить за процессом загрузки (progressbar не работает)');
        }
        if(!$.support.fileSending) {
            console.log('* Ваш браузер не поддерживает объект FormData (отправка с ручной формировкой запроса)');
        }
        console.log('Выбор файлов поддерживается');
    }
    console.log('*** Проверка поддержки ***');


});