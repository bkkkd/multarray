# Description #
A multidimensional array export/import CSV file tool library.


# demo #

    $data = array(
        '_id'=>'123',
        'name'=>array(
            'first'=>'Tim',
            'last'=>'Huang'
            )
         );
    echo MultArray::toCsv($data); // print thee csv file content as below

    $render = MultArray::fromCsv('.test.csv');//  it is same to $data

## csv file content ##

    _id,name[first],name[last]
    123,Tim,Huang

## php array ##

    array(
        '_id'=>'123',
        'name'=>array(
            'first'=>'Tim',
            'last'=>'Huang'
            )
         )


