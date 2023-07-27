# Explanation

## B05 - Lighthouse
Monolith Lighthouse result:
<div align="center">
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/lighthouse/login.jpg" width=700>
    <p align="center"><em>Login Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/lighthouse/register.jpg" width=700>
    <p align="center"><em>Register Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/lighthouse/catalog.jpg" width=700>
    <p align="center"><em>Catalog Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/lighthouse/productdetails.jpg" width=700>
    <p align="center"><em>Product Details Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/lighthouse/orderhistory.jpg" width=700>
    <p align="center"><em>Order History Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/lighthouse/cart.jpg" width=700>
    <p align="center"><em>Cart Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/lighthouse/about.jpg" width=700>
    <p align="center"><em>About Page</em></p>
    </br>
</div>

## B06 - Responsive Layout
Responsive layout, **things to notice: Navigation Bar**
<div align="center">
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/login/laptop.png" width=350>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/login/tablet.png" width=250>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/login/iphone.png" width=150>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/login/android.png" width=150>
    <p align="center"><em>Login Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/register/laptop.png" width=350>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/register/tablet.png" width=250>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/register/iphone.png" width=150>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/register/android.png" width=150>
    <p align="center"><em>Register Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/catalog/laptop.png" width=350>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/catalog/tablet.png" width=250>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/catalog/iphone.png" width=150>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/catalog/android.png" width=150>
    <p align="center"><em>Catalog Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/productdetails/laptop.png" width=350>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/productdetails/tablet.png" width=250>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/productdetails/iphone.png" width=150>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/productdetails/android.png" width=150>
    <p align="center"><em>Product Details Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/orderhistory/laptop.png" width=350>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/orderhistory/tablet.png" width=250>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/orderhistory/iphone.png" width=150>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/orderhistory/android.png" width=150>
    <p align="center"><em>Order History Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/cart/laptop.png" width=350>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/cart/tablet.png" width=250>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/cart/iphone.png" width=150>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/cart/android.png" width=150>
    <p align="center"><em>Cart Page</em></p>
    </br>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/about/laptop.png" width=350>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/about/tablet.png" width=250>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/about/iphone.png" width=150>
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/responsive/about/android.png" width=150>
    <p align="center"><em>About Page</em></p>
    </br>
</div>

## B07 - Dokumentasi API
You can read the full documentation here [Swagger](https://app.swaggerhub.com/apis/bangkitdc/single-service/1.0.0)

### Endpoint
By default, there was 3 APIs that you can use. Here it is :

#### Authentication
|Method| URL | Explanataion | Need Auth |
|--|--|--|:--:|
| GET | base_url/login | Login Page | |
| POST | base_url/login | Login | |
| GET | base_url/register | Register Page | |
| POST | base_url/register | Register | |
| POST | base_url/logout | Logout | |

#### Catalog
|Method| URL | Explanataion | Need Auth |
|--|--|--|:--:|
| GET | base_url/catalog | Get All Barang from Single Service, Display in Catalog Page | &#10004; |
| PUT | base_url/catalog | Update Barang to Single Service | &#10004; |
| GET | base_url/catalog/:id | Get Barang by ID (Product Details) from Single Service | &#10004; |

#### Cart
|Method| URL | Explanataion | Need Auth |
|--|--|--|:--:|
| GET | base_url/cart | Get All Barang in Cart, Display in Cart Page | &#10004; |
| POST | base_url/addtocart | Add Barang to Cart | &#10004; |
| PATCH | base_url/updatecart | Update Cart (Barang Qty) | &#10004; |
| DELETE | base_url/removefromcart | Delete Perusahaan by ID | &#10004; |

#### Order History
|Method| URL | Explanataion | Need Auth |
|--|--|--|:--:|
| GET | base_url/orderhistory | Get All Order History, Display in OrderHistory Page | &#10004; |

#### About
|Method| URL | Explanataion | Need Auth |
|--|--|--|:--:|
| GET | base_url/about | Get About Page | &#10004; |

## B08 - SOLID
1. Single Responsibility Principle (SRP)

Each component or class should have a single responsibility. I'm using Models-Controllers (MC) pattern and then added Middleware and Helper to support and provide great functionality for the application.

2. Open/Closed Principle (OCP)

Entities (classes, modules, functions) should be open for extension but closed for modification.

3. Liskov Substitution Principle (LSP)

The Liskov Substitution Principle (LSP) is primarily concerned with the behavior of objects in a class hierarchy and how derived types can be substituted for their base types without affecting the correctness of the program. Since my doesn't involve inheritance or class hierarchies, LSP is not directly applicable in this context.

4. Interface Segregation Principle (ISP)

The Interface Segregation Principle is about creating specific interfaces that are tailored to the needs of the clients that use them, rather than having large, monolithic interfaces.

5. Dependency Inversion Principle (DIP)

The DIP states that high-level modules should not depend on low-level modules; both should depend on abstractions. 

## B11 - Additional Features
1. Search Functionality
Based on barang's name or barang's product.

https://github.com/bangkitdc/monolith/assets/87227379/002db2b5-90f5-4ba5-a3ab-71fbf3f8fa9a


https://github.com/bangkitdc/monolith/assets/87227379/ec79ba7a-e264-4342-b44b-1e5a90e2cf68




https://github.com/bangkitdc/monolith/assets/87227379/ae37ede2-3c43-479f-9a62-95d2e7308461

