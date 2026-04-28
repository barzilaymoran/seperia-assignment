from flask import Flask, render_template, request
from services.products import get_products

app = Flask(__name__)

@app.route("/")
def index():
    search = request.args.get("search", "").strip()
    page = request.args.get("page", 1, type=int)

    try:
        data = get_products(search=search, page=page)
    except Exception as e:
        return render_template("index.html", error=str(e))

    return render_template("index.html", **data)

if __name__ == "__main__":
    app.run(debug=True)