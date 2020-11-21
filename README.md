# Stripe Apigility API

## Configuration

File: `config/autoload/local.php`

## Usage

### Create session (subscription mode)

Documentation: <https://stripe.com/docs/api/checkout/sessions/create>

```http
POST /checkout/session/plan
```

| Parameter  | Required     | Description                                                                                           |
|------------|--------------|-------------------------------------------------------------------------------------------------------|
| successUrl | **required** | The URL to which Stripe should send customers when payment or setup is complete.                      |
| cancelUrl  | **required** | The URL the customer will be directed to if they decide to cancel payment and return to your website. |
| plan       | **required** | [Plan ID](https://stripe.com/docs/api/plans) for this item.                                           |
| locale     | (optional)   | The IETF language tag of the locale Checkout is displayed in.                                         |

### Create session (payment mode)

Documentation: <https://stripe.com/docs/api/checkout/sessions/create>

```http
POST /checkout/session/donation
```

| Parameter  | Required     | Description                                                                                           |
|------------|--------------|-------------------------------------------------------------------------------------------------------|
| successUrl | **required** | The URL to which Stripe should send customers when payment or setup is complete.                      |
| cancelUrl  | **required** | The URL the customer will be directed to if they decide to cancel payment and return to your website. |
| amount     | **required** | The amount to be collected per unit of the line item.                                                 |
| currency   | **required** | Three-letter [ISO currency code](https://www.iso.org/iso-4217-currency-codes.html), in lowercase.     |
| locale     | (optional)   | The IETF language tag of the locale Checkout is displayed in.                                         |

### Ping

```http
GET /ping
```
