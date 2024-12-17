Revenue Models


Service
    Company will give a web Product 
    Client need to pay Subscription
    Company will yields revenue from Subscription
    -
        Netflix        
        Hotstar
        Airbnb
Ads
    Company will give free service
    Client neef to see Ads
    Company will Yield Revenue from Ad Owners
    -
        Youtube
        Meta
        Spotify

Product client need to to Buy - Revenue

Developing a Platform which enables the sales and Purchase
-----------------------------------------------------------
E-Commerce

Minimum Viable Product
---

Scope:

Roles & Responsibilities
------------------------

Superadmin
    Manage the Platform - MVP
    Update Fixes and Releases
Vendor
    Authentication - MVP
        UI
            username
            password
            userttype
        API
            receive
            validate
            create DB connection
            store in DB
        DB
            create table user
                userid - AI int primary
                username - varchar(100)
                password - varchar(100)
                usertype - varchar(10)
                created_date - timestamp default current_timestamp

    Upload Products -= MVP
        name,price,descriptions,images
    View Products - MVP
             View Orders - TASK
    Manage Returns/Refund
    Manage Delivery Partner

Customer
    Authentication - MVP
    View Products - MVP
          Search Products 
          Compare Products
    Cart Management - MVP
        Add
        View
        Delete
    Add/View Reviews
           Place Order - TASK
        COD
    Return   
