<div class="panel panel-default">
    <div class="panel-heading">Menu</div>

    <div class="panel-body">
        <a href="{{ route('admin_clients') }}" onclick="getContent(this.href, event, 'clients')">
            <li id="clients">Clients</li>
        </a> <hr>
        <a href="{{ route('admin_products') }}" onclick="getContent(this.href, event, 'products')">
            <li id="products">Products</li>
        </a> <hr>
        <a href="{{ route('admin_orders') }}" onclick="getContent(this.href, event, 'orders')">
            <li id="orders">Orders</li>
        </a>
    </div>
</div>