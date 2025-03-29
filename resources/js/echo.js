if(import.meta.env.VITE_BROADCAST_DRIVER != null){

    if (import.meta.env.VITE_BROADCAST_DRIVER == 'pusher') {
        var pusher = new Pusher(import.meta.env.VITE_PUSHER_APP_KEY, {
            cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
            authEndpoint: '/broadcasting/auth'
        });

        var channel = pusher.subscribe('private-broadcast');
        channel.bind('bell', function(data) {
            window.Livewire.dispatch('bell');
        });
    }
    else if (import.meta.env.VITE_BROADCAST_DRIVER == 'ably') {

        async function subscribe() {

            const realtime = new Ably.Realtime.Promise(import.meta.env.VITE_ABLY_KEY);
            const channel = realtime.channels.get("private-broadcast");
            await channel.subscribe("bell", (message) => {
                window.Livewire.dispatch('bell');
            });

          };

        subscribe();
    }
}

