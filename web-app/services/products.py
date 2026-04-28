import requests

BASE_URL = "https://dummyjson.com"
PAGE_SIZE = 30 # products per page


def get_products(search: str = "", page: int = 1):
    skip = (page - 1) * PAGE_SIZE # skip offset as a page number

    if search:
        url = f"{BASE_URL}/products/search"
    else:
        url = f"{BASE_URL}/products"

    # HTTP call to DummyJSON API
    response = requests.get(url, params={
        "q": search,
        "limit": PAGE_SIZE,
        "skip": skip
    })
    response.raise_for_status()
    data = response.json()

    total_pages = -(-data["total"] // PAGE_SIZE)  # ceiling division

    return {
        "products": data["products"],
        "total": data["total"],
        "current_page": page,
        "total_pages": total_pages,
        "search": search
    }