## B01 - OWASP
1. A03-Injection (SQL)

In a SQL injection attack, the attacker manipulates the application's input fields to inject malicious SQL code into the database query. If the application does not properly validate or sanitize user input and directly includes it in the SQL query, the injected code will be executed by the database, leading to unauthorized access or unintended actions.

Here's an example of a vulnerable SQL query:
``` sql
SELECT * FROM users WHERE username = 'admin' AND password='password123'
```
In this query, the application is checking the 'username' and 'password' fields for login purposes.

An attacker can perform a SQL injection by inputting the following into the username field:
``` sql
admin' OR '1'='1
```

The SQL injection manipulates the query to the following:
``` sql
SELECT * FROM users WHERE username = 'admin' OR '1'='1' AND password='password123'
```
By typing ```admin' OR '1'='1``` in the username field and with a random password, the user will log in successfully.

OR
``` sql
' or 1=1--
```
This query returns the first user in the database as validation for the username field, because 1 does in fact equal 1, while ignoring the request for a password due to the comment at the end.

https://github.com/bangkitdc/monolith/assets/87227379/0c40a90b-1eed-468a-a3f3-4e03a83fd329

<div align="center">
    <img width="400" alt="image" src="https://github.com/bangkitdc/monolith/assets/87227379/7d9883f5-3265-450e-848d-ad447f702520">
    <img width="400" alt="image" src="https://github.com/bangkitdc/monolith/assets/87227379/e3b0bb19-ea16-4e71-ae3d-6bb09a000197">
</div>
</br>

2. A01 - Broken Access Control

Access control enforces a policy such that users cannot act outside of their intended permissions. Failures typically lead to unauthorized information disclosure, modification, or destruction of all data or performing a business function outside the user's limits.

https://github.com/bangkitdc/monolith/assets/87227379/298d91f5-b080-4ad9-ba5a-e170ca7c2c0b


I'm implementing middleware for every route that can be accessed by authenticated users.

Single Service
``` go
// Protected routes (Middleware)
api := router.PathPrefix("/").Subrouter()
api.Use(middleware.JWTMiddleware)

// User
api.HandleFunc("/self", selfcontroller.GetSelf).Methods("GET")

// Barang
api.HandleFunc("/barang", barangcontroller.GetBarangs).Methods("GET")
api.HandleFunc("/barang/{id}", barangcontroller.GetBarangByID).Methods("GET")
api.HandleFunc("/barang", barangcontroller.CreateBarang).Methods("POST")
api.HandleFunc("/barang/{id}", barangcontroller.UpdateBarang).Methods("PUT")
api.HandleFunc("/barang/{id}", barangcontroller.DeleteBarang).Methods("DELETE")
```

Monolith
``` php
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}

// OrderHistory
Route::get('/orderhistory', [OrderHistoryController::class, 'showOrderHistory'])
  ->name('orderhistory')
  ->middleware('auth');

// About
Route::get('/about', [AboutController::class, 'showAbout'])
  ->name('about')
  ->middleware('auth');
```

3. A04 - Insecure Design

Design flaws can lead to significant security vulnerabilities that are difficult to address without re-architecting the application. The main idea behind A04 is to emphasize the importance of secure design principles and threat modeling early in the development process. Implementation:

<div align="center">
    <img width="600" alt="image" src="https://github.com/bangkitdc/monolith/assets/87227379/15173cf5-c839-47da-8838-3d9200568163">
    <p align="center"><em>Input Validation</em></p>
    </br>
    <img width="600" alt="image" src="https://github.com/bangkitdc/monolith/assets/87227379/1a29f926-7daa-44c1-be7b-cce6048007dd">
    <p align="center"><em>Good Auth Mechanism</em></p>
    </br>
    <img width="600" alt="image" src="https://github.com/bangkitdc/monolith/assets/87227379/3d759ad2-9d0f-4e99-8539-b21af3300c47">
    <p align="center"><em>"No Data" Handling</em></p>
    </br>
    <img width="600" alt="image" src="https://github.com/bangkitdc/monolith/assets/87227379/35a36b9c-997a-4986-9361-7d983f49c0c4">
    <p align="center"><em>Constraint Handling</em></p>
</div>

## B04 - Polling
In my application, all data is fetched and rendered on the server side, and updating the HTML content with JavaScript would lead to performance issues. To address this, I decided to implement a polling-like technique on the front-end side. The approach involves refreshing the entire page every 5 minutes to ensure the displayed information is up-to-date. While this method may not be considered the best practice due to potential drawbacks such as increased bandwidth usage and server load, it provides a simple and effective way to keep the data current without introducing complex client-side scripting. As my application primarily relies on server-side rendering, this polling approach meets my immediate needs.

```javascript
// Function to reload the page
function refreshPage() {
    window.location.reload(true);
}

// Refresh the page every 5 minutes
setInterval(refreshPage, 300000);
```

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
You can read the full documentation here [Swagger](https://app.swaggerhub.com/apis/bangkitdc/monolith/1.0.0)

### Endpoint
By default, there were 5 APIs that you can use. Here it is :

#### Authentication
|Method| URL | Explanation | Need Auth |
|--|--|--|:--:|
| GET | base_url/login | Login Page | |
| POST | base_url/login | Login | |
| GET | base_url/register | Register Page | |
| POST | base_url/register | Register | |
| POST | base_url/logout | Logout | &#10004; |

#### Catalog
|Method| URL | Explanation | Need Auth |
|--|--|--|:--:|
| GET | base_url/catalog | Get All Barang from Single Service, Display in Catalog Page | &#10004; |
| PUT | base_url/catalog | Update Barang to Single Service | &#10004; |
| GET | base_url/catalog/:id | Get Barang by ID (Product Details) from Single Service | &#10004; |

#### Cart
|Method| URL | Explanation | Need Auth |
|--|--|--|:--:|
| GET | base_url/cart | Get All Barang in Cart, Display in Cart Page | &#10004; |
| POST | base_url/addtocart | Add Barang to Cart | &#10004; |
| PATCH | base_url/updatecart | Update Cart (Barang Qty) | &#10004; |
| DELETE | base_url/removefromcart | Delete Perusahaan by ID | &#10004; |

#### Order History
|Method| URL | Explanation | Need Auth |
|--|--|--|:--:|
| GET | base_url/orderhistory | Get All Order History, Display in OrderHistory Page | &#10004; |

#### About
|Method| URL | Explanation | Need Auth |
|--|--|--|:--:|
| GET | base_url/about | Get About Page | &#10004; |

## B08 - SOLID
1. Single Responsibility Principle (SRP)

The SRP states that a class should have only one reason to change, meaning it should have a single responsibility or purpose. I'm using MVC Design (Model-View-Controller).

- Login
- Register
- Cart
- Catalog
- Order History

Every module has its own MVC structure.

2. Open/Closed Principle (OCP)

The OCP states that entities (classes, modules, functions) should be open for extension but closed for modification. It means you should be able to extend the behavior of an entity without modifying its existing code.

``` php
class CatalogController extends Controller
{
  /**
   * Display the catalog
   *
   * @return \Illuminate\Http\Response
   */

    //
}

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */

    //
}

```

3. Liskov Substitution Principle (LSP)

The LSP states that objects of a superclass should be replaceable with objects of its subclasses without affecting the correctness of the program.

``` php
public function updateCatalog(Request $request)
  {
    //

          // Create the OrderHistory if not created already
          if (!$orderhistory) {
            $orderhistory = OrderHistory::create([
              'user_id' => $request->user()->id,
              'total_harga' => 0,
            ]);
          }

          // Create the OrderItem record and associate it with the OrderHistory
          $orderItem = new OrderItem([
            'nama' => $barang['nama'],
            'quantity' => $barang['quantity'],
            'harga' => $barang['harga'],
          ]);

          $orderhistory->orderItems()->save($orderItem);

    //
  }

public function getRecommendation(Request $request, $except) {
    // Get the currently authenticated user
    $user = $request->user();

    // Retrieve the last OrderHistory for the user
    $orderhistory = $user->orderhistory()->latest()->first();

    if ($orderhistory) {
      // Get the order items for the last OrderHistory
      $orderItems = $orderhistory->orderItems;

      // Shuffle the array of order items randomly
      $shuffledOrderItems = $orderItems->shuffle();
      $randomOrderItem = $shuffledOrderItems->take(1);

    //

}
```

Superclass can be replaceable with objects of its subclasses and not affecting the correctness of the program.

4. Interface Segregation Principle (ISP)

The Interface Segregation Principle is about creating specific interfaces that are tailored to the needs of the clients that use them, rather than having large, monolithic interfaces.

The User implicitly implements interface JWTSubject. Since the JWTSubject interface has two required methods (getJWTIdentifier() and getJWTCustomClaims()), and the User class provides the implementations for these methods, it implicitly adheres to the JWTSubject interface.

``` php
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    //

    // Methods from the JWTSubject interface
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
```

5. Dependency Inversion Principle (DIP)

The DIP states that high-level modules should not depend on low-level modules; both should depend on abstractions. 

The CatalogController class depends on external components like the HTTP client and the OrderHistory and OrderItem models. However, it seems that the controller is not directly instantiating these dependencies but rather receiving them through dependency injection. The Http::get method and OrderHistory model are injected into the CatalogController constructor and method parameters, respectively.

## B10 - Automated Testing
I made Unit Test per Feature based on the page/ controller of the application. Here is the example of LoginTest.
```php
<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function testValidLogin(): void
    {
        // Create a test user with a known password
        $user = User::create([
            'first_name' => 'test123',
            'last_name' => 'test123',
            'username' => 'test123',
            'email' => 'test123@example.com',
            'password' => bcrypt('testpassword'),
        ]);

        $response = $this->post(route('login'), [
            'email_username' => 'test123@example.com', // Use the email as the input
            'password' => 'testpassword', // Use the known password
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('catalog');
        $this->assertAuthenticatedAs($user); // Ensure the user is authenticated
    }

    public function testInvalidLogin(): void
    {
        $response = $this->post(route('login'), [
            'email_username' => 'asdfgh@example.com', // Use a non-existent email
            'password' => 'asdfghjkl', // Use an invalid password
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['loginError']); // Ensure login error message exists in the session

        $this->assertGuest(); // Ensure no user is authenticated
    }
}
```

You can check out the full Unit Test in tests/Feature.

https://github.com/bangkitdc/monolith/assets/87227379/92d75288-d019-4cf6-94a9-5a0968572c14

## B11 - Additional Features
1. Search Functionality

Based on Barang's name or Barang's product. (Catalog Search)

https://github.com/bangkitdc/monolith/assets/87227379/d6e385fb-7aac-4981-a4d5-85cb0384ca67

Based on Barang's name in Order History or the year of Order History created. (Order History Search)

https://github.com/bangkitdc/monolith/assets/87227379/ee41ceab-c745-495e-a8b4-da6a94c883d9

</br>

I'm using debouncing search for responsiveness and making sure not to waste API calls.

``` javascript
// Debounce Search
// Debounce function to delay the search execution
function debounce(func, wait) {
  let timeout;
  return function () {
    const context = this;
    const args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      func.apply(context, args);
    }, wait);
  };
}

// Function to perform the search and update results
function performSearch() {
  const q = $('#searchInput').val();

  // AJAX request to the PHP script
  window.location.href = "{{ route('catalog', ['q' => '']) }}" + q;
}

// Attach event listener to the search input field with debounce
const searchInput = $('#searchInput');
searchInput.on('input', debounce(performSearch, 1000)); // debounce time
// Set the initial value of the search input field on page load
$(document).ready(function() {
  const initialValue = {!! json_encode($q) !!};

  if (initialValue !== null) {
    searchInput.focus();
  }
  searchInput.val(initialValue);
});
```

2. Cart Icon

Using a session in PHP to update the cart, and then added the alert (toastify-like) to make the user know what's happening. To add responsiveness also, all input handles are in the frontend. if the stock of one of the Barang in the middle of the transaction got less than the stock, then the transaction will be failed. Every successful transaction will update the DB in Single Service.

https://github.com/bangkitdc/monolith/assets/87227379/0671e613-534f-4740-86a5-a7786c263009

3. Barang Recommendation

Barang Recommendations are based on the last user's transaction/ order. Recommendations based on the same Perusahaan as the Barang on the last transaction. If there is more than 1 Barang, then it will random the choice. I set the recommendations to be a maximum of 4 Barangs. If there are more than 4 Barangs, then it will also randomize so that always be a maximum of 4 Barangs. The page Barang that's being open won't be on recommendations.

https://github.com/bangkitdc/monolith/assets/87227379/a175defb-a9a1-4079-a027-fd486ce99b0e

``` php
  public function getRecommendation(Request $request, $except) {
    // Get the currently authenticated user
    $user = $request->user();

    // Retrieve the last OrderHistory for the user
    $orderhistory = $user->orderhistory()->latest()->first();

    if ($orderhistory) {
      // Get the order items for the last OrderHistory
      $orderItems = $orderhistory->orderItems;

      // Shuffle the array of order items randomly
      $shuffledOrderItems = $orderItems->shuffle();
      $randomOrderItem = $shuffledOrderItems->take(1);

      // Get the names ('nama') of the random order item
      $randomOrderItemName = $randomOrderItem->pluck('nama')->first();

      // Make the HTTP request to the API endpoint with the page parameter
      $baseUrl = config('app.api_base_url');
      $response = Http::get($baseUrl . '/barang-noauth-recommendation?nama=' . $randomOrderItemName . '&except=' . $except);

      // Check if the request was successful
      if ($response->successful()) {
        // Retrieve the data from the response
        $data = $response->json();

        // Extract the necessary data for the table
        $barangs = $data['data'];

        $recommendation = [];
        foreach ($barangs as $barang) {
          if ($barang['nama'] != $except) {
            array_push($recommendation, $barang);
          }
        }

        return $recommendation;
      }
    } else {
      return [];
    }
    return [];
  }
```

