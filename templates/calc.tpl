<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculator</title>
</head>

<body>
    <form action="?action=calculate" method="post">
        <fieldset>
            <legend>Калькулятор</legend>
            <p><label for="operand1">Операнд 1</label>
                <input type="text" name="operand1" value="{OP1}">
                <select name="operator">
                    <option {SELECTED_VALUE0} value="+">Прибавить</option>
                    <option {SELECTED_VALUE1} value="-">Вычесть</option>
                    <option {SELECTED_VALUE2} value="*">Умножить</option>
                    <option {SELECTED_VALUE3} value="/">Разделить</option>
                </select>
                <label for="operand2">Операнд 2</label>
                <input type="text" name="operand2" value="{OP2}">
                <p><label for="operand2">Результат</label>
                    <input type="text" name="result" value="{RESULT}" disabled></p>
        </fieldset>
        <p><input type="submit" value="Сalculate"></p>
        <p>
        <input type="submit" name = "operator" value="+">
        <input type="submit" name = "operator" value="-">
        <input type="submit" name = "operator" value="*">
        <input type="submit" name = "operator" value="/">
        </p>
    </form>
</body>
</html>