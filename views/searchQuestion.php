<html>
    <head>
        <title>Knowledge Search</title>
    </head>
    <body>
        <form action="index.php" method ="post">
            <table>
                <tr>
                    <td>Your short question here</td>
                    <td><input type='text' name='question' value='<?php echo $question; ?>' size='100'></td>
                </tr>
                <tr>
                    <td>Tags</td>
                    <td><input type='text' name='tags' value='<?php echo $tags; ?>' size='100'></td>
                </tr>
                <tr>
                    <td>Full detail of your Question</td>
                    <td><textarea name ='detail' ><?php echo $detail;?></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Search'>
                        <input type='submit' value='Knowledge'>
                        <input type='hidden' name='task' value='search'>
                    </td>
                </tr>
            </table>
        </form>
        <hr>
    </body>
</html>