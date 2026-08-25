# Version Log

## August 24, 2026 - POS Tax Selection Fix

### What Changed

- The tax list on the POS product row now matches the tax rates saved for that business.
- When a business has its own tax rates, users will see those same tax names on the POS screen.
- The POS tax dropdown will no longer show tax names from another business.
- Tax rate changes made in **Settings > Tax Rates** will be reflected on the POS screen.

### How Users Check It

1. Go to **Settings > Tax Rates**.
2. Check the tax names saved for the business.
3. Open the **POS** screen.
4. Add a product to the bill.
5. Open the tax dropdown in the product row.
6. Confirm that the same tax names are shown.

### Example

For Alaska Bar, the POS product tax dropdown should show:

- GST ON CARD
- GST ON CASH

### Benefits for Customers

- Staff can select the correct tax while making a sale.
- Each business sees only its own tax rates.
- Billing becomes clearer and easier to manage.
- This reduces mistakes when multiple businesses use the same system.

## August 24, 2026 - AiAssistance OpenAI Setup

### What Changed

- AiAssistance is now a business feature instead of a package-only option controlled by the application manager.
- Each business can connect and use its own OpenAI account.
- Business owners can open **Settings > AiAssistance (OpenAI)** to set up their OpenAI account.
- The OpenAI key is saved for that business and is used for AI tools inside the application.
- The AI Messenger can guide users inside the software and answer common questions about features, workflows, and reports.
- The OpenAI settings page now includes a simple **How to Connect with OpenAI** guide at the bottom.

### How Business Owners Use It

1. Go to **Settings**.
2. Open **AiAssistance (OpenAI)**.
3. Turn on OpenAI for the business.
4. Paste the OpenAI API key.
5. Save and test the connection.
6. After setup, users can use AI tools and the AI Messenger inside the application.

### Important Note

This feature uses the OpenAI API account of the business. It does not use a ChatGPT website login. Any OpenAI usage cost belongs to the business account that provides the API key.

### Benefits for Customers

- Customers can use their own OpenAI account.
- They control their own AI cost and usage.
- Staff can ask the AI Messenger for help while using the software.
- New users can learn workflows faster.
- Business owners can add custom instructions for how the AI should guide their team.
- AI tools can help with product descriptions, reports, business insights, messages, and document reading.

### Benefits for the Application Manager

- The application manager does not need to pay for every customer’s OpenAI usage.
- Customers manage their own OpenAI account and billing.
- Support workload can reduce because the AI Messenger answers common software questions.
- AiAssistance is easier to offer as a built-in feature.
- The application becomes more helpful and modern without forcing one shared AI account for everyone.
