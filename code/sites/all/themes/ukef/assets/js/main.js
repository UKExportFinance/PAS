var PAGE;
//window.IS_PROTOTYPE || (window.IS_PROTOTYPE =false)
//jQuery.noConflict();
(function ($) {
  "use strict";
  PAGE = (function () {

  function initWebformElementAddMore() {

    

    function getValues (target) {
      var valuesStr = $('textarea', target).val();

      var values = [];

      var valuesChunks = valuesStr.split("\n");

      var i;

      // Last chunk is empty so ignore it.
      var x = valuesChunks.length - 1;

      for (i = 0; i < x; i++) {
        var valuesChunksSub = valuesChunks[i].split(';');

        var valuesSub = [];

        var i2;

        // Last chunk is empty so ignore it.
        var x2 = valuesChunksSub.length - 1;

        for (i2 = 0; i2 < x2; i2++) {
          valuesSub.push(valuesChunksSub[i2]);
        }

        values.push(valuesSub);
      }

      return values;
    }

    function write(target, container) {
      var output = '';

      $.each(
        $('.webform-element-add-more-record', container),
        function () {
          $.each(
            $('input, select', this),
            function () {
                // add if data-attr == ignore skip this statement
                    // (add ignore to 3 date fields)
                var ignore = this.dataset.ignore;
                // if not ignore
                if(!ignore){

                    switch (this.type) {
                        case 'checkbox':
                            if (this.checked) {
                                output += 'on;';
                            }
                            else {
                                output += ';';
                            } 
                            break;

                        default:
                            
                            output += this.value + ';';

                            break;
                    }
                }
            }
          );
          output += "\n";
        }
      );

      $('textarea', target).val(output);
    }

    if( $(".webform-element-add-more").length > 0){
      var path = "/ukef_webform/ajax/webform_element_add_more";
      $(".webform-element-add-more").each(function(i){

        var target = this;
        
        if (!$('textarea', this).length) {
          return;
        }

        $('textarea', this).hide();
        
        var values = getValues(target);

        var url, input = $(this), 
          src = input.data("webform-element-add-more-src"), 
          nid = input.data("webform-element-add-more-nid");

        url = path + '?src=' + src + '&nid=' + nid;

        $.getJSON({
          url: url
        }).done(function(data) {
          if (data === null) {
            // Getting config data failed.
            $('textarea', this).show();
            return;
          }

          var recordCount = 1;

          //console.log(data);

          // gets basic set up for the section fields
          var conf = data.conf;

          // create table wrapper, addMoreWrapper == addMoreWrapper
          var addMoreWrapper = document.createElement('div');

          addMoreWrapper.className = 'webform-element-add-more-wrapper';

          // create table wrapper, addMoreWrapper == addMoreWrapper
          var addMoreRecords = document.createElement('div');

          addMoreRecords.className = 'webform-element-add-more-records';

          // add table to wrapper
          addMoreWrapper.appendChild(addMoreRecords);

          // set up addmore function
          var addMore = function(values) {

            // create record 
            var record = document.createElement('div');

            record.className = 'webform-element-add-more-record';

            // create header area for record, will contain label, hide / show button and remove button

            var header = document.createElement('div');

            header.className = 'record-header';

            record.appendChild(header);

            // set up record label

            var recordLabel = document.createElement('h3');

            header.appendChild(recordLabel);

            recordLabel.className = 'record-label';

            recordLabel.innerHTML = data.record_label;

           

            // add record to record container
            addMoreRecords.appendChild(record);

            // want to prepend the main wrapper, so that the add more button is always at the bottom
            addMoreWrapper.insertBefore(addMoreRecords, buttonAddMore);
            
            var i;

            // get length of fields
            var x = conf.length;

            // create container for fields

            var recordFields = document.createElement('div');

            recordFields.className = 'record-fields';

            // for each field
            for (i = 0; i < x; i++) {
              // create cell
              var field = document.createElement('div');
              // add class
              field.className = 'webform-element-add-more-record-field form-item form-group';


              // every input should have a label so adding here

              var label = document.createElement('label');

              // if field is optional add optional label
              var labelText = conf[i].required ? conf[i].label : conf[i].label + " (optional)";

              // add label text to label
              label.innerHTML = labelText;


            // some form items have a form hint

            var hint = document.createElement('p');

            hint.className = 'form-hint';

            if(conf[i].hint != null){

                hint.innerHTML = conf[i].hint;
            
            }

            // Add prefix

            var prefix = document.createElement('span');
            prefix.className = 'field-prefix';

            if(conf[i].prefix != null){

                prefix.innerHTML = conf[i].prefix + " ";
            
            }

            // Add suffix

            var suffix = document.createElement('span');
            suffix.className = 'field-suffix';

            if(conf[i].suffix != null){

                suffix.innerHTML = " " + conf[i].suffix ;
            
            }
            

            // if input type is
            switch (conf[i].type) {
                case 'checkbox':
                  // set appropriate class to field
                  field.className += ' form-type-checkbox';

                  // add additional wrapper for field

                  var fieldWrapper = document.createElement('div');

                  fieldWrapper.className = 'form-checkboxes form-group';

                  fieldWrapper.appendChild(field)


                  label.className = 'webform-element-add-more-record-checkbox-label option';

                  field.appendChild(label);

                  var input = document.createElement('input');

                  if (values) {
                      if (values[i] == 'on') {
                        input.checked = true;
                      }

                  }

                  input.type = 'checkbox';

                  input.className = 'webform-element-add-more-record-checkbox form-checkbox';

                  $(input).on(
                      'change',
                      function() {
                          write(target, addMoreRecords);
                      }
                  );

                  label.appendChild(input);

                  recordFields.appendChild(fieldWrapper);

                  break;

                case 'date':

                    // Create date wrapper
                    var dateWrapper = document.createElement('div');
                    
                    dateWrapper.className = 'date-wrapper webform-container-inline webform-component-date';

                    //dateWrapper.appendChild(field);

                    label.className = 'webform-element-add-more-record-date';
                    
                    // Add label and form hint to wrapper
                    dateWrapper.appendChild(label);

                    dateWrapper.appendChild(hint);

                    // Add hidden input to field
                    var hiddenInput = document.createElement('input');

                    hiddenInput.className = 'webform-element-add-more-input date';

                    var dates = ["","",""];

                    if (values && values[i]) {
                        hiddenInput.value = values[i];
                        
                        // split out values into array to be added to dummy fields

                        dates = values[i].split("/");

                    }

                    hiddenInput.type = 'hidden';



                    
                    
                    var dateSettingsArray = ['day', 'month', 'year'];
                    // Add 3 x dummy input fields to form
                    var dummyWrapper = document.createElement('div');
                    dummyWrapper.className = 'webform-container-inline date-parent';

                    for(var y = 0; y < 3; y++){

                        var wrap = document.createElement('div');
                        wrap.className = 'form-item';

                        var label = document.createElement('label');
                        label.className = 'element-invisible';
                        label.htmlFor = dateSettingsArray[y]+i;

                        var input = document.createElement('input');

                        input.id = dateSettingsArray[y]+i;

                        // add value

                        input.value = dates[y];

                        // add ignore data attribute

                        input.dataset.ignore = true;

                        input.className = 'form-text';
                        y == 2 ? (input.size = 4) : (input.size = 2);
                        y == 2 ? (input.maxLength = 4) : (input.maxLength = 2);
                        
                        wrap.appendChild(label);
                        wrap.appendChild(input);

                        dummyWrapper.appendChild(wrap);

                        $(input).on(
                            'change',
                            function() {
                                var parent = $(this).closest('.date-parent');
                                var data = "";
                                $(parent).find('input').each( function(i){
                                    var date = $(this).val();
                                    i < 2 ? data += date + "/" : data += date;
                                })
                                parent.siblings('input').val(data);
                                $(hiddenInput).change();
                            }

                        );
                    }

                    $(hiddenInput).on(
                        'change',
                        function() {
                          write(target, addMoreRecords);

                        }
                    );


                    dateWrapper.appendChild(dummyWrapper);

                    dateWrapper.appendChild(hiddenInput);

                    field.appendChild(dateWrapper);

                    recordFields.appendChild(field);

                    break;

                case 'text':
                    var input = document.createElement('input');

                    field.appendChild(label);

                    field.appendChild(hint);

                    if (values && values[i]) {
                        input.value = values[i];
                    }

                    input.className = 'webform-element-add-more-input form-text';

                    input.type = 'text';

                    field.appendChild(prefix);

                    field.appendChild(input);

                    field.appendChild(suffix);

                    $(input).on(
                        'change',
                        function() {
                            write(target, addMoreRecords);
                        }
                    );

                    recordFields.appendChild(field);

                    break;

                case 'number':
                    var input = document.createElement('input');

                    field.appendChild(label);

                    field.appendChild(hint);

                    if (values && values[i]) {
                        input.value = values[i];
                    }

                    input.type = 'number';

                    input.className = 'webform-element-add-more-input form-text form-number';

                    $(input).on(
                        'change',
                        function() {
                            write(target, addMoreRecords);
                        }
                    );

                    
                    field.appendChild(prefix);
                    
                    field.appendChild(input);

                    field.appendChild(suffix);

                    recordFields.appendChild(field);

                    break;

                case 'select':
                case 'select_country':
                  field.appendChild(label);

                  var select = document.createElement('select');

                  select.className = 'webform-element-add-more-table-select form-select';

                  field.appendChild(select);

                  if (typeof data.prepopulate !== 'undefined'
                  && typeof data.prepopulate[conf[i].key] !== 'undefined') {
                    var options = data.prepopulate[conf[i].key].options;

                    var key;

                    for(key in options) {
                      var option = document.createElement('option');

                      option.value = key;

                      if (values
                      && values[i] == key) {
                        option.selected = true;
                      }

                      option.innerHTML = options[key];

                      select.appendChild(option);
                    }
                  }

                    // Add an empty option to the start of the select field

                    var option = document.createElement('option');

                    option.value = false;

                    option.innerHTML = "None";
                    
                    select.insertBefore(option, select.firstChild);

                    $(select).on(
                        'change',
                        function() {
                          write(target, addMoreRecords);
                        }
                    );

                    recordFields.appendChild(field);

                    break;

                }
                        

              // add record fields to record

              record.appendChild(recordFields);


            } //  end of for loop

            // is the remove button
            var a = document.createElement('a');
            a.setAttribute('href', '#');
            a.innerHTML = 'Delete entry';
            a.className = 'webform-element-add-more-remove';

            header.appendChild(a);

            // on click remove and write to the textarea
            $(a).on(
              'click',
              function (ev) {
                ev.preventDefault();

                $(this.parentNode.parentNode).remove();

                write(target, addMoreRecords);
              }
            );
          }; // end of add more

          // if there are values
          if (values.length) {
            var i;

            var x = values.length;
            // for each row populate with the data
            for (i = 0; i < x; i++) {

              addMore(values[i]);
            }

          }
          else {
            // otherwise 
            addMore();
          }

          var buttonAddMore = document.createElement('button');
          buttonAddMore.type = 'button';
          buttonAddMore.innerHTML = 'Add another ' + data.record_label + " + ";
          buttonAddMore.className = 'button button-blue';
          $(buttonAddMore).on(
            'click',
            function() {
                recordCount++;
                addMore();
            }
          );

          // Add the add more button after the table 

          addMoreWrapper.appendChild(buttonAddMore);

          $('.guidance', target).after(addMoreWrapper);
        });
      });
    } 

  }

  return {
    // public members
    init: function () {
      initWebformElementAddMore();
    }
  };
}());

$(function () {
  PAGE.init();
});
}(jQuery));
