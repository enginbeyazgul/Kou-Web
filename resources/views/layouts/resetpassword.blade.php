<div style="width: 100%; display: flex; justify-content: center; margin-top: -10px">
    <form style="padding: 10px;border-radius: 0 0 45px 45px; background-color:aliceblue;margin: auto; display: flex; flex-direction: column; width: 400px; height: 120px; align-items: center" action="{{route('resetpassword')}}" method="post">@csrf
        <input style="margin: 15px 5px 10px 5px;width: 250px;padding: 8px;text-align: center;border: 1px solid #aaa;background-color: transparent; border-radius: 18px 4px 18px 4px;font-size: 17px;outline: none;" name="mail" placeholder="Mail" type="text">
        <input style="margin: 5px;width: 100px; padding: 7px;font-size: 16px;background-color: #1E9D4C;color: aliceblue; border-radius: 4px;border: none;text-decoration: none; cursor:pointer;" value="Sıfırla" type="submit">
    </form>
</div>
