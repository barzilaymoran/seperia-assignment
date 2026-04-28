<?php
if (!defined('ABSPATH')) {
    exit;
}

function ca_render_table() {
    $search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
    $page   = isset($_GET['page_num']) ? (int) $_GET['page_num'] : 1;

    $data = ca_get_products($search, $page);

    if (isset($data['error'])) {
        return '<p class="ca-error">' . esc_html($data['error']) . '</p>';
    }

    $products    = $data['products'];
    $total_pages = $data['total_pages'];
    $current_page = $data['current_page'];

    ob_start();
?>
    <div class="ca-container">

        <!-- Search Bar -->
        <form method="GET" action="">
            <input type="text" name="search" value="<?php echo esc_attr($search); ?>" placeholder="Search products...">
            <button type="submit">Search</button>
        </form>

        <?php if (empty($products)) : ?>
            <p class="ca-empty">No products found for "<?php echo esc_html($search); ?>".</p>

        <?php else : ?>
            <p class="ca-summary">Showing page <?php echo $current_page; ?> of <?php echo $total_pages; ?></p>
            <table class="ca-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
			<th>Brand</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Rating</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><img src="<?php echo esc_url($product['thumbnail']); ?>" alt="<?php echo esc_attr($product['title']); ?>"></td>
                        <td><?php echo esc_html(ca_get_field($product['title'])); ?></td>
			<td><?php echo esc_html(ca_get_field($product['brand'])); ?></td>
                        <td><?php echo esc_html(ca_get_field($product['description'])); ?></td>
                        <td><?php echo esc_html(ucfirst(ca_get_field($product['category']))); ?></td>
                        <td><?php echo esc_html(ca_get_field($product['rating'])); ?></td>
                        <td><?php echo esc_html(ca_get_field($product['stock'])); ?></td>
                        <td>$<?php echo esc_html(ca_get_field($product['price'])); ?></td>
                        <td><button class="ca-gallery-btn" data-id="<?php echo esc_attr($product['id']); ?>">Gallery</button></td>
                    </tr>
                    <tr id="gallery-<?php echo $product['id']; ?>" class="ca-gallery-row">
                        <td colspan="9">
                            <div class="ca-gallery-images">
                                <?php foreach (array_slice($product['images'], 0, 3) as $image) : ?>
                                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($product['title']); ?>">
                                <?php endforeach; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="ca-pagination">
                <a href="?search=<?php echo urlencode($search); ?>&page_num=<?php echo $current_page - 1; ?>"
                   class="<?php echo $current_page == 1 ? 'disabled' : ''; ?>">← Prev</a>

                <?php for ($p = 1; $p <= $total_pages; $p++) : ?>
                    <a href="?search=<?php echo urlencode($search); ?>&page_num=<?php echo $p; ?>"
                       class="<?php echo $p == $current_page ? 'active' : ''; ?>"><?php echo $p; ?></a>
                <?php endfor; ?>

                <a href="?search=<?php echo urlencode($search); ?>&page_num=<?php echo $current_page + 1; ?>"
                   class="<?php echo $current_page == $total_pages ? 'disabled' : ''; ?>">Next →</a>
            </div>
        <?php endif; ?>
    </div>

<?php
    return ob_get_clean();
}