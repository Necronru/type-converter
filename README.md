
Chrome about:trace report

```bash
rm trace.json && SPX_ENABLED=1 SPX_OUTPUT=gte SPX_OUTPUT_FILE=trace.json php test.php > /dev/null
```

Live report
```bash
SPX_ENABLED=1 SPX_FP_LIVE=1 php test.php
```

Optimize composer autoload

```bash
composer dump -o -a --apcu
```