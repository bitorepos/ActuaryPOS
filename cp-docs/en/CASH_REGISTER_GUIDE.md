# Cash Register Management

The **Cash Register** feature in {application_name} helps you track money going in and out of each register (till). You can record the opening balance, track all transactions, and close out the register at the end of a shift.

---

## What You'll Learn

- How to open a cash register
- How to track cash in and cash out
- How to close a register and view the summary
- How to count cash denominations

---

## How to Open a Cash Register

1. Go to the **POS** screen.
2. If no register is open, you'll be prompted to **Open Register**.
3. Enter the **Opening Cash** amount — how much cash is physically in the drawer.
4. Click **Open Register**.

📸 *[Screenshot: The Open Cash Register dialog with the opening cash amount field]*

> 💡 **Tip:** Always count the cash in the drawer before opening the register. This ensures your records match the actual cash on hand.

---

## How to View the Current Register

1. On the POS screen, click the **Cash Register** icon/button.
2. You'll see a summary of the current register:
   - **Opening Balance** — what you started with
   - **Total Sales** — cash collected from sales
   - **Cash In** — extra cash added to the register (e.g. change float top-up)
   - **Cash Out** — cash removed from the register (e.g. petty cash, expenses)
   - **Current Balance** — the expected amount in the drawer right now

📸 *[Screenshot: The current cash register summary panel]*

---

## How to Record Cash In / Cash Out

### Cash In (Adding Money)

1. On the POS screen, click the **Cash Register** icon.
2. Click **Cash In**.
3. Enter the **Amount** and a **Note** describing why (e.g. "Change float top-up").
4. Click **Save**.

### Cash Out (Removing Money)

1. On the POS screen, click the **Cash Register** icon.
2. Click **Cash Out**.
3. Enter the **Amount** and a **Note** describing why (e.g. "Office supplies purchase").
4. Click **Save**.

📸 *[Screenshot: The Cash In / Cash Out dialog with amount and note fields]*

---

## How to Close a Cash Register

At the end of a shift or day:

1. On the POS screen, click the **Cash Register** icon.
2. Click **Close Register**.
3. You'll see a summary of all transactions.
4. Enter the **Closing Cash** — the actual cash counted in the drawer.
5. The system will show the **Difference** (expected vs. actual):
   - **Zero** — perfect! The register balances.
   - **Positive** — there's extra cash (overage).
   - **Negative** — cash is short (shortage).
6. Add any closing notes if needed.
7. Click **Close Register**.

📸 *[Screenshot: The Close Register dialog showing the expected vs. actual amounts and difference]*

> ⚠️ **Important:** Always investigate any shortage before closing the register. Talk to the cashier to understand the discrepancy.

---

## Cash Denomination Counting

When closing the register, you can break down the cash by denomination:

1. On the Close Register screen, look for the **Denomination** section.
2. Enter the count for each denomination:
   - How many ₨5000 notes?
   - How many ₨1000 notes?
   - How many ₨500 notes?
   - (and so on for all denominations)
3. The system automatically calculates the total.
4. This total becomes your **Closing Cash** amount.

📸 *[Screenshot: The denomination counting table with note/coin types and quantities]*

> 💡 **Tip:** Denomination counting makes closing more accurate and helps identify errors.

---

## Viewing Register History

To see past register sessions:

1. Go to **Cash Register** from the left sidebar (or **Reports → Register Report**).
2. You'll see a list of all past register sessions with:
   - **Open Time** and **Close Time**
   - **User** — who operated the register
   - **Opening Balance** and **Closing Balance**
   - **Total Sales** and **Difference**
3. Click on a session to see the full transaction details.

📸 *[Screenshot: The register history list showing past sessions]*

---

## Settings & Options

| Setting | What It Does | Where to Find It |
|---|---|---|
| **Enable Cash Register** | Turn on the cash register feature | Business Settings → POS |
| **Cash Denomination** | Enable/disable denomination counting | Business Settings → POS |
| **Auto-Open Register** | Automatically open register when POS loads | Business Settings → POS |
| **Restrict to One Open Register per User** | Prevent multiple registers per user | Business Settings → POS |

---

## Common Questions

**Q: Can two cashiers use the same register?**
A: It's best practice for each cashier to have their own register session. This makes accountability easier.

**Q: What if I forgot to close the register yesterday?**
A: Open the register details and close it with the correct closing amount. Make a note explaining the late closure.

**Q: Can I re-open a closed register?**
A: No, once closed, a register session is finalised. Start a new session instead.

**Q: Where do I see all register reports?**
A: Go to **Reports → Register Report** for a complete history.

**Q: Can the manager close someone else's register?**
A: Depending on permissions, a manager may be able to close any open register.

---

## Tips & Best Practices

- 📌 **Count cash before opening** — ensure the opening amount matches actual cash
- 📌 **Record every cash out** — even small amounts, to maintain accuracy
- 📌 **Close daily** — close the register at the end of every shift
- 📌 **Use denominations** — count by denomination for more accurate closing
- 📌 **Investigate shortages immediately** — don't just close and move on