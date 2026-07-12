/**
 * ReceiptTemplates.js
 * FINAL VERSION - Alignment Tengah + Logo Fix
 */

if (!window.ReceiptTemplates) {
    const COMMANDS = {
        RESET: "\x1B\x40",
        ALIGN_LEFT: "\x1B\x61\x00",
        ALIGN_CENTER: "\x1B\x61\x01",
        ALIGN_RIGHT: "\x1B\x61\x02",
        BOLD_ON: "\x1B\x45\x01",
        BOLD_OFF: "\x1B\x45\x00",
        TEXT_NORMAL: "\x1B\x21\x00",
        TEXT_DOUBLE_HEIGHT: "\x1B\x21\x10",
        TEXT_DOUBLE_WIDTH: "\x1B\x21\x20",
        TEXT_QUAD: "\x1B\x21\x30",
        CUT_PAPER: "\x1D\x56\x41\x00",
    };

    class ReceiptTemplates {
        constructor() {
            this.encoder = new TextEncoder();
        }

        formatRibuan(number) {
            return parseInt(number || 0).toLocaleString("id-ID");
        }

        formatDate(date) {
            if (!date)
                return new Date()
                    .toLocaleDateString("id-ID")
                    .replace(/\//g, "-");
            return new Date(date)
                .toLocaleDateString("id-ID")
                .replace(/\//g, "-");
        }

        formatItemLine(name, qty, price, subtotal) {
            const qtyText = `${qty}x`;
            const priceText = `@${this.formatRibuan(price)}`;
            const totalText = this.formatRibuan(subtotal);
            let itemLine = name + "\n";
            const line2 =
                qtyText.padEnd(5) +
                priceText.padEnd(15) +
                totalText.padStart(12);
            return itemLine + line2;
        }

        // ================= ALIGNMENT YANG ANDA INGINKAN =================
        // Label + " :" di tengah, Nominal di pojok kanan
        centerLabelRightValue(label, value, width = 32) {
            const labelPart = label + " :";
            const valueStr = String(value);

            // Diubah jadi lebih pas di tengah
            const centeredLabel = labelPart.padStart(20).padEnd(23);
            const remainingSpace = width - centeredLabel.length;

            return centeredLabel + valueStr.padStart(remainingSpace);
        }

        async customerCopy(data) {
            const chunks = [];
            chunks.push(this.encoder.encode(COMMANDS.RESET));

            // LOGO
            if (data?.store?.logo_url) {
                try {
                    const logoBytes = await this._buildLogoRasterBytes(
                        data.store.logo_url,
                    );
                    if (logoBytes) chunks.push(logoBytes);
                } catch (e) {
                    console.warn("⚠️ Logo gagal dibuat:", e);
                }
            }

            let receipt = "";

            // HEADER
            receipt += COMMANDS.ALIGN_CENTER;
            receipt += COMMANDS.BOLD_ON;
            receipt += (data.store?.name || "ALAS BU YANTI") + "\n";
            receipt += COMMANDS.BOLD_OFF;
            receipt +=
                (data.store?.address || "Jl. Raya Ciawi Prapatan No.6") + "\n";
            receipt += "Selamat Datang :)\n";
            receipt += "--------------------------------\n";

            // INFO
            receipt += COMMANDS.ALIGN_LEFT;
            receipt += "Date      : " + this.formatDate(data.date) + "\n";

            const orderType = (data.order?.order_type || "").toLowerCase();
            const isQuickService = orderType !== "dine_in";
            const infoText =
                orderType === "dine_in"
                    ? data.table_number || "-"
                    : data.order?.code || "-";

            receipt += "Info      : " + infoText + "\n";
            receipt +=
                "Purpose   : " +
                (orderType === "dine_in" ? "DINE IN" : "TAKE AWAY") +
                "\n";
            receipt += "Cashier   : " + (data.name_kasir || "Kasir") + "\n";
            receipt += "--------------------------------\n";

            // ITEMS
            let totalItems = 0;
            if (data.items && Array.isArray(data.items)) {
                data.items.forEach((item) => {
                    const name = item.product?.name || item.name || "Item";
                    const qty = item.quantity || 0;
                    const price = item.price || 0;
                    const subtotal = qty * price;
                    totalItems += qty;
                    receipt +=
                        this.formatItemLine(name, qty, price, subtotal) + "\n";
                });
            }
            receipt += "--------------------------------\n";

            // TOTALS
            const subtotal = parseInt(data.order?.subtotal || 0);
            const promotionDiscount = parseInt(
                data.order?.promotion_discount_amount || 0,
            );
            let servicePercent = parseFloat(
                data.order?.service_percentage || 0,
            );
            const service = isQuickService
                ? 0
                : parseInt(
                      data.order?.service_amount ||
                          Math.round(subtotal * (servicePercent / 100)),
                  );
            const tax = parseInt(data.order?.tax_amount || 0);
            const grandTotal = parseInt(data.order?.total || 0);
            const roundingAmount = parseInt(data.order?.rounding_amount || 0);

            receipt += `${totalItems} items\n`;
            receipt +=
                this.centerLabelRightValue(
                    "Subtotal",
                    this.formatRibuan(subtotal),
                ) + "\n";

            // if (promotionDiscount > 0)
            //     receipt +=
            //         this.centerLabelRightValue(
            //             "Promotion",
            //             "-" + this.formatRibuan(promotionDiscount),
            //         ) + "\n";

            if (service > 0)
                receipt +=
                    this.centerLabelRightValue(
                        "Service Charge",
                        this.formatRibuan(service),
                    ) + "\n";

            if (tax > 0)
                receipt +=
                    this.centerLabelRightValue("PB1", this.formatRibuan(tax)) +
                    "\n";

            receipt += "--------------------------------\n";

            // STATUS
            const status = (
                data.order?.payment_status || "pending"
            ).toLowerCase();
            let statusText = "--- Not Paid ---";
            if (status === "paid") statusText = "--- Thank You ---";
            else if (status === "voided") statusText = "--- Void ---";

            // GRAND TOTAL
            receipt += COMMANDS.ALIGN_CENTER;
            receipt += COMMANDS.TEXT_DOUBLE_HEIGHT;
            receipt += COMMANDS.BOLD_ON;
            receipt +=
                this.centerLabelRightValue(
                    "Grand Total",
                    this.formatRibuan(grandTotal),
                ) + "\n";
            receipt += COMMANDS.TEXT_NORMAL;
            receipt += COMMANDS.BOLD_OFF;
            receipt += "--------------------------------\n";
            receipt += `${statusText}\n\n\n`;
            receipt += COMMANDS.CUT_PAPER;

            chunks.push(this.encoder.encode(receipt));
            return this._concatBytes(chunks);
        }

        // ================= LOGO - VERSI STABIL =================
        async _buildLogoRasterBytes(url) {
            try {
                const img = await this._loadImage(url);
                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");

                const maxWidth = 250; // lebih aman
                const scale = Math.min(1, maxWidth / img.width);
                const width = Math.floor(img.width * scale);
                const height = Math.floor(img.height * scale);

                canvas.width = width;
                canvas.height = height;
                ctx.fillStyle = "#FFFFFF";
                ctx.fillRect(0, 0, width, height);
                ctx.drawImage(img, 0, 0, width, height);

                const imageData = ctx.getImageData(0, 0, width, height).data;
                const bytesPerLine = Math.ceil(width / 8);
                const bitmap = new Uint8Array(bytesPerLine * height);

                for (let y = 0; y < height; y++) {
                    for (let x = 0; x < width; x++) {
                        const i = (y * width + x) * 4;
                        const gray =
                            imageData[i] * 0.299 +
                            imageData[i + 1] * 0.587 +
                            imageData[i + 2] * 0.114;
                        if (gray < 155) {
                            const byteIndex =
                                y * bytesPerLine + Math.floor(x / 8);
                            bitmap[byteIndex] |= 0x80 >> (x % 8);
                        }
                    }
                }

                const header = new Uint8Array([
                    0x1d,
                    0x76,
                    0x30,
                    0, // m=0 (paling kompatibel)
                    bytesPerLine & 0xff,
                    (bytesPerLine >> 8) & 0xff,
                    height & 0xff,
                    (height >> 8) & 0xff,
                ]);

                return this._concatBytes([
                    this.encoder.encode(COMMANDS.ALIGN_CENTER),
                    header,
                    bitmap,
                    new Uint8Array([0x0a, 0x0a]),
                ]);
            } catch (e) {
                console.error("Gagal proses logo:", e);
                return null;
            }
        }

        _loadImage(url) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                // img.crossOrigin = "anonymous";
                // img.onload = () => resolve(img);
                // img.onerror = () => reject(new Error("Gagal load logo"));
                // img.src = url;
                // Coba tanpa crossOrigin dulu, fallback jika gagal
                img.onload = () => resolve(img);
                img.onerror = () => {
                    // Retry tanpa crossOrigin
                    const img2 = new Image();
                    img2.onload = () => resolve(img2);
                    img2.onerror = () => reject(new Error("Gagal load logo"));
                    img2.src = url + "?t=" + Date.now(); // cache bust
                };
                img.crossOrigin = "anonymous";
                img.src = url;
            });
        }

        _concatBytes(chunks) {
            const arrays = chunks.filter(Boolean);
            const totalLength = arrays.reduce((sum, a) => sum + a.length, 0);
            const out = new Uint8Array(totalLength);
            let offset = 0;
            arrays.forEach((a) => {
                out.set(a, offset);
                offset += a.length;
            });
            return out;
        }

        kitchenCopy(data, stationName = "KITCHEN") {
            // Isi dengan kode kitchen copy kamu yang lama
        }

        // Tambahkan di dalam class ReceiptTemplates
        endShiftReport(data) {
            const chunks = [];
            chunks.push(this.encoder.encode(COMMANDS.RESET));

            let receipt = "";

            // 1. HEADER (Tengah)
            receipt += COMMANDS.ALIGN_CENTER;
            receipt += COMMANDS.BOLD_ON;
            receipt += "LAPORAN TUTUP KASIR\n";
            receipt += "PENJUALAN MENU\n";
            receipt += COMMANDS.BOLD_OFF;
            receipt += "--------------------------------\n";

            // 2. INFO KASIR (Kiri)
            receipt += COMMANDS.ALIGN_LEFT;
            receipt += "Kasir       : " + (data.cashier_name || "-") + "\n";
            receipt += "Waktu Buka  : " + (data.open_time || "-") + "\n";
            receipt += "Waktu Kasir : " + (data.close_time || "-") + "\n";
            receipt += "--------------------------------\n";

            // 3. PRODUK TERJUAL
            receipt += COMMANDS.BOLD_ON;
            receipt += "Produk Terjual\n";
            receipt += COMMANDS.BOLD_OFF;
            receipt += "--------------------------------\n";

            if (data.items && data.items.length > 0) {
                data.items.forEach((item) => {
                    // Nama produk di kiri, jumlah di kanan
                    const name = item.name.substring(0, 20); // Potong jika terlalu panjang
                    const qty = String(item.total_qty);
                    const spaces = 32 - name.length - qty.length;
                    receipt +=
                        name + " ".repeat(spaces > 0 ? spaces : 1) + qty + "\n";
                });
            } else {
                receipt += "Tidak ada penjualan.\n";
            }

            receipt += "--------------------------------\n";

            // 4. TOTAL (Kanan)
            const totalQty = String(data.total_all_qty || 0);
            const label = "TOTAL";
            const totalSpaces = 32 - label.length - totalQty.length;
            receipt +=
                label +
                " ".repeat(totalSpaces > 0 ? totalSpaces : 1) +
                totalQty +
                "\n";

            receipt += "--------------------------------\n";
            receipt += COMMANDS.ALIGN_CENTER;
            receipt += "Shift Selesai\n\n\n\n";
            receipt += COMMANDS.CUT_PAPER;

            chunks.push(this.encoder.encode(receipt));
            return this._concatBytes(chunks);
        }
    }

    window.ReceiptTemplates = new ReceiptTemplates();
}
