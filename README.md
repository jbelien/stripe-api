# Stripe API

**Compatible with [Stripe API version `2022-11-15`](https://stripe.com/docs/upgrades#2022-11-15)**

## Configuration

File: `src/.env` (you can copy-paste content of `src/.env.example`)

## Usage

### Create checkout session - Subscription mode

Documentation: <https://stripe.com/docs/api/checkout/sessions/create>

```http
POST /checkout/session/subscription
```

| Parameter  | Required     | Description                                                                                           |
|------------|--------------|-------------------------------------------------------------------------------------------------------|
| successUrl | **required** | The URL to which Stripe should send customers when payment or setup is complete.                      |
| cancelUrl  | **required** | The URL the customer will be directed to if they decide to cancel payment and return to your website. |
| plan       | **required** | [Plan ID](https://stripe.com/docs/api/plans) for this item.                                           |
| locale     | (optional)   | The IETF language tag of the locale Checkout is displayed in.                                         |

> **Note**
>
> If you're upgrading from version 1.x, you must use `subscription` instead of `plan` in the request URL.

### Create checkout session - Payment mode

Documentation: <https://stripe.com/docs/api/checkout/sessions/create>

```http
POST /checkout/session/payment
```

| Parameter  | Required     | Description                                                                                           |
|------------|--------------|-------------------------------------------------------------------------------------------------------|
| successUrl | **required** | The URL to which Stripe should send customers when payment or setup is complete.                      |
| cancelUrl  | **required** | The URL the customer will be directed to if they decide to cancel payment and return to your website. |
| amount     | **required** | The amount to be collected per unit of the line item.                                                 |
| currency   | **required** | Three-letter [ISO currency code](https://www.iso.org/iso-4217-currency-codes.html), in lowercase.     |
| message    | (optional)   | The description for the line item, to be displayed on the Checkout page.                              |
| locale     | (optional)   | The IETF language tag of the locale Checkout is displayed in.                                         |

> **Note**
>
> If you're upgrading from version 1.x, you must use `payment` instead of `donation` in the request URL.
