<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Input Field for Array Example</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <style type="text/css">
        body {
        .entry:not(:first-of-type) {
            margin-top: 10px;
        }
        .glyphicon {
            font-size: 12px;
        }
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1>Bootstrap Input Field for Array Example</h1>


    <script id="template_add_form" type="text/template">
        <div class = "entry input-group col-xs-9">
            <div class = "col-xs-3">
                <input class = "form-control" name="balance" type = "text"
                       placeholder = "Loan Balance" required = "required"/>
            </div>
            <div class="col-xs-3">
                <input class="form-control" name="rate" type="text" placeholder="Interest Rate" required="required" />
            </div>
            <div class="col-xs-3">
                <input class="form-control" name="payment" type="text" placeholder="Minimum Payment" required="required"/>
            </div>
            <span class="input-group-btn col-xs-1">
            <button class="btn btn-success btn-add" type="button">
                <span class="glyphicon glyphicon-plus"></span >
            </button>
        </span>
        </div>
    </script>

    <div class="container">
        <div class="row">
            <div class="control-group" id="fields">
                <label class="control-label" for="field1">
                    <h3>Enter your loans below</h3>

                </label>
                <div class="controls">
                    <form id="loanform" role="form" autocomplete="off" method="post">
                        <div class="entry input-group col-xs-3">How much extra money can you pay per month?
                            <input class="form-control" name="extra" type="text" placeholder="Extra/month" />
                        </div>
                        <br>
                        <div id="entries"></div>
                </div>
                <div class="input-group-btn">
                    <div class="col-xs-5">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                </form>
                <br> <small>Press <span class="glyphicon glyphicon-plus gs"></span> to add another loan</small>

            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and jQuery (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"  crossorigin="anonymous"></script>
<script type="application/javascript">
    $(function() {
        //console.log($('#template_add_form'));
        var clone = function(tmpl) {
                return $((tmpl.clone()).html())
            },
            $template = $('#template_add_form'),
            formArray = [ clone($template) ], // init array with first row
            $formEntries = $('#entries');

        $(document).on('click', '.btn-add', function() {
            //console.log('clicked');
            formArray.push(clone($template));
            updateForm();
            // set focus to adding row = last element in array
            $(formArray).last()[0]
                .find('input')
                .first()
                .focus();
        });

        // remove not working yet

        $(document).on('click', '.btn-remove', function(evt) {
            var id;
            // iterate over formArray to find the currently clicked row
            $.each(formArray, function(index, row) {
                //console.log(index, row.has(evt.currentTarget).length);
                if ( row.has(evt.currentTarget).length == 1 ) {
                    //console.log(row.has(evt.currentTarget));
                    id = index; // click target in current row
                    return false; // exit each loop
                }
            });

            //console.log('clicked', id);
            formArray.splice(id, 1);
            updateForm();
        });

        var updateForm = function() {
            // redraw form --> problem values are cleared!!
            //console.log(formArray);
            var lastIndex = formArray.length - 1,
                name; // stores current name of input

            $formEntries.empty(); // clear entries from DOM becaue we re-create them
            $.each(formArray, function(index, $input) {
                //console.log(index, $input);
                // update names of inputs and add index
                //console.log('inputs', $input.find('input'));
                $.each($input.find('input'), function(inputIndex, input) {
                    name = $(input).attr('name').replace(/\d+/g, ''); // remove ids
                    $(input).attr('name', name + index);
                });

                if (index < lastIndex) {
                    // not last element --> change button to minus
                    //console.log($input.find('.btn-add'));
                    $input.find('.btn-add')
                        .removeClass('btn-add').addClass('btn-remove')
                        .removeClass('btn-success').addClass('btn-danger')
                        .html('<span class="glyphicon glyphicon-minus"></span>');
                }

                $formEntries.append($input);
            });
        };

        updateForm(); // first init. of form

        $('form#loanform').submit(function(evt) {
            evt.preventDefault();
            var fields = $(this).serializeArray();
            $.each(fields, function(index, field) {
                //console.log(field.name);
                if ( field.name == 'extra' ) {
                    console.log('extra', field.name, field.value);
                }
                if ( field.name.contains('balance') )
                {   // field.name contains balance
                    console.log('balance', field.name, field.value);
                    // now you can do your calculation
                }
                if ( field.name.contains('rate') )
                {   // field.name contains balance
                    console.log('rate', field.name, field.value);
                    // now you can do your calculation
                }
                if ( field.name.contains('payment') )
                {   // field.name contains balance
                    console.log('payment', field.name, field.value);
                    // now you can do your calculation
                }
            });
        });
    });
</script>
</body>
</html>
