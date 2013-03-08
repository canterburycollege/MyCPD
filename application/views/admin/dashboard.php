<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Admin Dashboard Page</h1>
        <ul>
            <li><?= anchor("admin/faculty/","Manage Faculties") ?><br/>
                Create, edit, delete and manage Faculties.
            </li>
            <br />
            <li>
                <?= anchor("admin/section/","Manage Sections") ?><br/>
                Create, edit, delete and manage Sections.
            </li>
            <br />
            <li><?= anchor("admin/user/","Manage Users") ?><br/>
                Create, edit, delete and manage Users.
            </li>
            <br />
            <li><?= anchor("admin/learning_plan/","Manage Learning Plans") ?><br/>
                Create, edit, delete and manage Learning Plans.
            </li>
            <br />
            <li><?= anchor("admin/news/","Manage News") ?><br/>
                Create, edit, delete and manage News articles.
            </li>
            <br />
            <li><?= anchor("admin/calendar/","Manage Calendar") ?><br/>
                Create, edit, delete and manage Calendar entries.
            </li>
            <br />
        </ul>
    </body>
</html>
