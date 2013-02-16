<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Install Dashboard Page</h1>
        <ul>
            <li><?= anchor("install/init_db/create_db","Create database") ?><br/>
                Create initial database (WARNING: Will drop existing database).
            </li>
            <br />
            <li><?= anchor("install/init_db/add_data","Add data") ?><br/>
                Add pre-defined data.
            </li>
        </ul>
    </body>
</html>
