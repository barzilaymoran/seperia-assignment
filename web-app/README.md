# Products Table Assignment - Web App

A server-side rendered web application that fetches and displays products from the DummyJSON API 
with search, pagination and a product image gallery.


## Features

- Products Table: displays Title, Brand, Description, Category, Rating, Stock, Price and Thumbnail (as an image)
- Search: search products by keyword, handled server-side
- Pagination: navigate through all products, 30 per page
- Gallery: expand any product row to view up to 3 product images (if exist)


## Tech Stack

- Backend: Python, Flask
- Templating: Jinja2
- HTTP Client: requests
- Frontend: Plain HTML, CSS and JavaScript (no frameworks)
- Data Source: DummyJSON API


## Getting Started

### Prerequisites

- Python 3.x

### Installation

1. Clone the repository and navigate to the project folder:
	- cd web-app
2. Create and activate a virtual environment: 
	- python3 -m venv venv
	- source venv/bin/activate  # macOS/Linux
	- venv\Scripts\activate     # Windows
3. Install dependencies:
	- pip install -r requirements.txt
4. Run the app:
    - python3 app.py
5. Visit in your browser:
	http://127.0.0.1:5000


## How It Works

All dynamic features are handled server-side, the browser receives fully rendered HTML on every request.
- Browser → Flask route → DummyJSON API
- Browser ← HTML page  ← Jinja2 template

1. The browser sends a request to Flask with optional search and page URL parameters
2. Flask calls get_products() which fetches data from DummyJSON
3. Jinja2 renders the HTML template with the returned data
4. The browser displays the finished page, no client-side data fetching


## API

This app uses the DummyJSON Products API.

- Endpoint: `GET /products` | Usage: Fetch all products with pagination

- Endpoint: `GET /products/search?q=` | Usage: Search products by keyword


## Edge Cases Handled

- Empty search: falls back to full product listing
- No results: displays a friendly message
- API failure: catches exception and displays error message
- Invalid page number: falls back to page 1
- Missing brand field: displays an empty string as fallback
- Products with fewer than 3 images: gallery shows available images up to a maximum of 3


## Assumptions

- DummyJSON API structure remains stable
- All products have an images array
- PAGE_SIZE is fixed at 30 products per page
- DummyJSON handles all search logic
- Single user environment: no caching or session management
