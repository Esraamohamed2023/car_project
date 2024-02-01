use App\Models\Message;

if (!function_exists('messagecount')) {
    function messagecount()
    {
        return Message::count();
    }
}