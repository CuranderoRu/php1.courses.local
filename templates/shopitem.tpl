            <a href="?action=viewitem&item_id={item_id}" class="item">
                <div class="item_top">
                    <img src="/img/tumbs/{item_img}" alt="">
                    <div class="item_desr">{item_descr}</div>
                </div>
                <div class="item_comment">{item_comment}</div>
                <div class="item_comment item_price">{item_price}</div>
                <form action="?action=addtocart&item_id={item_id}" method="post" class = "item_form">
                   Количество<input type="number" name="quantity" max=10 min=0>
                   <button type="submit" >Купить</button>
                </form>
            </a>
