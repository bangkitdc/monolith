# Explanation

## B05 - Lighthouse
Monolith Lighthouse result:
<div align="center">
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/login.jpg" width=700>
    <p align="center"><em>Login Page</em></p>
</div>
</br>
<div align="center">
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/register.jpg" width=700>
    <p align="center"><em>Register Page</em></p>
</div>
</br>
<div align="center">
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/catalog.jpg" width=700>
    <p align="center"><em>Catalog Page</em></p>
</div>
</br>
<div align="center">
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/productdetails.jpg" width=700>
    <p align="center"><em>Product Details Page</em></p>
</div>
</br>
<div align="center">
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/orderhistory.jpg" width=700>
    <p align="center"><em>Order History Page</em></p>
</div>
</br>
<div align="center">
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/cart.jpg" width=700>
    <p align="center"><em>Cart Page</em></p>
</div>
</br>
<div align="center">
    <img src="https://github.com/bangkitdc/monolith/blob/main/img/about.jpg" width=700>
    <p align="center"><em>About Page</em></p>
</div>
</br>

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
